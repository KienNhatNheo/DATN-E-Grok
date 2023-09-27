<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    //Trang chủ
    public function homepage(){  
        $product_new = Product::orderBy('product_id', 'desc')->where('product_display',1)->limit(8)->get();
        $product_discount = Product::where('product_discount','>',0)->where('product_display',1)->orderBy('product_discount', 'desc')->limit(8)->get();
        $product_hot = Product::orderBy('product_rating', 'desc')->where('product_display',1)->limit(8)->get();
        return view('homepage', compact('product_new','product_discount','product_hot'));
    }

    //Đăng nhập
    public function login(Request $request){
        $loginResult = User::login($request);
        if($loginResult == 1){
            //admin
            $request->session()->put('isLog', 1);
            return Redirect::to('admin');
        } 
        else if($loginResult == 2){
            //user
            $searchCount = DB::table('search_result')->get();
        $searchHot = array();
        foreach($searchCount as $item){
            array_push($searchHot,$item->search_key);
        }
        $counts = array_count_values($searchHot);
        arsort($counts);
        $keys = array_keys($counts);
        session()->put('searchHot',$keys);
            $request->session()->put('isLog', 1);
            return Redirect::to('/');
        }
        else if($loginResult == 3){
            //tài khoản bị khóa
            echo 'Tài khoản đã bị khóa';
        }
        else {
            echo "Bạn đã nhập sai tài khoản và mật khẩu";
        }
    }
    
    //Đăng ký
    public function register(Request $request){
        $registerResult = User::addUser($request);
        if($registerResult == 1){
            return Redirect::to('login');
        } else if($registerResult == 2){
            echo 'Số điện thoại này đã được sử dụng';
        }
        else {
            echo 'Mật khẩu không trùng khớp';
        }
    }

    //Đăng xuất
    public function logout(Request $request){
        User::logout();
        return Redirect::to('/');
    }

    //Lấy thông tin của 1 sản phẩm
    public function get_product_info($id){
        $info = Product::get_product_info_by_id($id);
        $comment = Product::get_comment($id);
        $sameTypeProduct = Product::sameTypeProduct($id);
        $popWithProduct = Product::popWithProduct($id);
        $infoPop = Product::infoPop($popWithProduct);
        return view('product_info', compact('info','comment','sameTypeProduct','infoPop'));
    }

    //Thông tin người dùng
    public function userInfo(){
        $user_id = session('curUser');
        $info = User::user_info($user_id);
        return view('userInfo', compact('info'));
    }
    //Giỏ hàng
    public function cart(){

    }
    
    //Cập nhật thông tin người đùng
    public function updateInfo(){
        $user_id = session('curUser');
        $info = User::user_info($user_id);
        return view('updateInfo', compact('info'));
    }

    //Xử lí cập nhật thông tin người dùng
    public function handle_updateInfo(Request $request){
        $username = $request->usernamec;
        $phone = $request->phonec;
        $email = $request->emailc;
        $address = $request->addressc;

        $checkPhone = User::checkPhone($phone);
        if($checkPhone == 2){
            $request->session()->put(['isUpdate' => 1]);
            return Redirect::to('userInfo');
        } else {
            User::update_userInfo($username, $phone, $address, $email);
            $request->session()->put(['isUpdate' => 2]);
            return Redirect::to('userInfo');
        }
    }

    //Thay đổi mật khẩu
    public function changePassword(){
        return view('changePassword');
    }

    public function handle_changePassword(Request $request){
        $newPass = $request->newPass;
        $confirm_newPass = $request->confirm_newPass;
        $curPass = $request->curPass;
        echo '1';
        if($newPass == $confirm_newPass){
            $result = User::changePass($curPass,$newPass);
            if($result == 1){
                $request->session()->put('isChange', 1);//Đổi mật khẩu thành công
                return Redirect::to('userInfo');//->Quay về trang thông tin người dùng
            } else {
                $request->session()->put('isChange', 2);//ĐỔi mật khẩu thất bại do sai mật khẩu cũ
                return Redirect::to('userInfo');//->Quay về trang thông tin người dùng
            }
        } else {
            $request->session()->put('isChange', 3);//ĐỔi mật khẩu thất bại do nhập sai mật khẩu mới
            return Redirect::to('userInfo');//->Quay về trang thông tin người dùng
        }
    }

    //Thêm vào giỏ hàng
    //Ngay cả khi chưa đăng nhập cũng có thể thêm vào giỏ hàng
    public function addToCart(Request $request){
        $product_id = $request->pro_id;
        $product_quantity = $request->pro_quantity;
        //khi người dùng đã đăng nhập
        if(session()->has('curUser')){
            $check = Product::checkExistCart($product_id);
            if($check == 1){
                Product::addToCart($product_id,$product_quantity);
            } else {
                Product::updateQuantity($product_id,$product_quantity);
            }
            return redirect()->back();
        } 
        //khi chưa đăng nhập
        else if(!session()->has('curUser')){
            //khi chưa có sản phẩm nào trước đó
            if(session('curCart') == null){
                session()->put('curCart',array());//Gán cho 1 mảng rỗng
                $curCart = session('curCart');//Tạo biến để gán giá trị session
                array_push($curCart, array($product_id,$product_quantity));//Đẩy sản phẩm vừa thêm vào giỏ hàng
                session()->put('curCart',$curCart); 
            } 
            //khi đã có sản phẩm và tiếp tục thêm vào giỏ hàng
            else {
                $curCart = session('curCart');
                for($i = 0;$i < count($curCart);$i ++){
                    if($curCart[$i][0] == $product_id){
                        $curCart[$i][1] += $product_quantity;
                    } else {
                        array_push($curCart, array($product_id,$product_quantity));
                    }
                }
                
                session()->put('curCart',$curCart); 
            }
            return redirect()->back()->withInput();
        }
    }

    //Xem giỏ hàng
    public function viewCart(){
        $sum = 0;
        $cartItem = array();
        //khi đã đăng nhập rồi
        if(session()->has('curUser')){
            $user_id = session('curUser');
            $cartHistory = Product::viewCart_byID($user_id);
            if(session()->has('curCart')){
                $curCart = session('curCart');
                Product::addCurCart($curCart);
                $cart = Product::viewCart_byID($user_id);
                session()->forget('curCart');
            } else {
                $cart = $cartHistory;
            }
            if($cart == null){
                return view('cart',compact('cart'));
            }
            for($i=0;$i<count($cart);$i++){
                $cartItemInfo = Product::get_product_info_by_id($cart[$i][1]);
                foreach($cartItemInfo as $item){
                    $price = $item->product_price*(100-$item->product_discount)/100;
                    $cartItemArr = array($item->product_id,$item->product_name,$item->product_image,$price);
                   
                }
                array_push($cartItem, $cartItemArr);
                $sum += $cart[$i][2]*$cartItem[$i][3];
            }
            $address = DB::table('user')->where('user_id',session('curUser'))->get();
            return view('cart', compact('cart','cartItem','sum','address'));
        } 
        //khi chưa đăng nhập
        else {
            $cart = session('curCart');
            if($cart == null){
                return view('cart',compact('cart'));
            }
            for($i=0;$i<count($cart);$i++){
                $cartItemInfo = Product::get_product_info_by_id($cart[$i][0]);
                foreach($cartItemInfo as $item){
                    $price = $item->product_price*(100-$item->product_discount)/100;
                    $cartItemArr = array($item->product_id,$item->product_name,$item->product_image, $price);
                }
                array_push($cartItem, $cartItemArr);
                $sum += $cart[$i][1]*$cartItem[$i][3];
            }
            return view('cart', compact('cart','cartItem','sum'));
        }
    }

    //Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($index){
        if(session()->has('curCart')){
            $cart = session('curCart');
            
            for($i = 0;$i < count($cart);$i ++ ){
                if($i == $index){
                    array_splice($cart, $index, 1);
                }
            }
            session()->put('curCart',$cart);
            return redirect()->back();
        } else {
            Product::removeCartItem($index);
            return redirect()->back();
        }
    }

    
    //Lọc các từ khóa được tìm kiếm nhiều trong phần tìm kiếm
    public function searchFilter(){

    }

    //Thanh tìm kiếm
    public static function searchResult(Request $request){
        $searchKey = $request->searchKey;
        $searchResult = DB::table('product')->where('product_name','like','%'.$searchKey.'%')->orWhere('product_type','like','%'.$searchKey.'%')->paginate(8);
        if($searchKey != null){
            DB::table('search_result')->insert([
                'search_key'=> $searchKey
            ]);
            $key = null;
        }
        $searchCount = DB::table('search_result')->get();
        $searchHot = array();
        foreach($searchCount as $item){
            array_push($searchHot,$item->search_key);
        }
        $counts = array_count_values($searchHot);
        arsort($counts);
        $keys = array_keys($counts);
        session()->put('searchHot',$keys);
        gettype(session('searchHot'));
        return view('search_result',compact('searchResult','searchKey'));
    }

    public static function search($key){
        $searchResult = DB::table('product')->where('product_name','like','%'.$key.'%')->orWhere('product_type','like','%'.$key.'%')->paginate(8);
        if($key != null){
            DB::table('search_result')->insert([
                'search_key'=> $key
            ]);
        }
        $searchCount = DB::table('search_result')->get();
        $searchHot = array();
        foreach($searchCount as $item){
            array_push($searchHot,$item->search_key);
        }
        $counts = array_count_values($searchHot);
        arsort($counts);
        $keys = array_keys($counts);
        session()->put('searchHot',$keys);
        return view('search_result',compact('searchResult','key'));
    }



    //Form đánh giá sản phẩm
    public function evaluateForm($product_id){
        $product_info = DB::table('product')->where('product_id',$product_id)->get();
        return view('evaluateForm', compact('product_info'));
    }

    //Xử lí đánh giá sản phẩm
    public function evaluate_handle(Request $request){
        $commentContent = $request->comment;
        $ratePoint = $request->point;
        $product_id = $request->eval_id;//Input dạng hidden
        Product::addComment($commentContent, $ratePoint, $product_id);
        Product::updateAvgPoint($product_id);
        return redirect()->back();
    }

    //Mua hàng
    public function purchase(Request $request){
        if(session()->has('curUser')){
            //Có người dùng sẽ thực hiện thanh toán
            $code = Product::generate_order_id();
            $address = $request->address;
            $sumPrice = $request->priceSum;
            if($sumPrice < 150000){
                $sumPrice += 30000;
            }
            $payBy = $request->payBy;
            if($payBy == null){
                $payBy = 'Sau khi nhận hàng';
            }
            $cart = DB::table('cart')->where('user_id', '=', session('curUser'))->orderBy('cart_id','desc')->get();
            //Thêm sản phẩm từ giỏ hàng vào lịch sử
            foreach($cart as $item){
                DB::table('purchase_history')->insert([
                    'product_id' => $item->product_id,
                    'purchaseQuantity' => $item->product_num,
                    'purchaseCode'=> $code
                ]);
                $proIn = Product::get_product_info_by_id($item->product_id);
                foreach($proIn as $i){
                    DB::table('product')->where('product_id',$item->product_id)->update(['product_sold'=>$i->product_sold + $item->product_num]);
                    DB::table('product')->where('product_id',$item->product_id)->update(['product_available'=>$i->product_available - $item->product_num]);
                }
                
            }
            //Sau khi thêm các sản phẩm vào lịch sử thì sẽ xóa các sản phâm trong giỏ hàng
            DB::table('cart')->delete();
            //Thêm thông tin đơn hàng vào bảng order
            DB::table('order')->insert([
                'user_id' => session('curUser'),
                'orderCode' => $code,
                'address'=>$address,
                'isReceive' => 0,
                'orderPrice' => $sumPrice,
                'payMethod' => $payBy,
                'time' => date('Y-m-d H:i:s') 
            ]);
            session()->put('notifi','1');
            return Redirect::to('');
        } else {
            //Không có người dùng thì sẽ yêu cầu đăng nhập
            return Redirect::to('login');
        }
    }

    //Xem lịch sử mua hàng
    public function history(){
        $history = Product::history();
        $productInOrder = DB::table('purchase_history')
                            ->join('product','product.product_id','=','purchase_history.product_id')
                            ->get();
        return view('history',compact('history','productInOrder'));
    }

    //Nhận hàng
    public function received($code){
        DB::table('order')
            ->where('orderCode','=',$code)
            ->update(['isReceive' => 1]);
        return Redirect::to('history');
    }

    //Trả về sản phẩm theo phân loại
    public function productType($key){
        $product = DB::table('product')->where('product_type','like','%'.$key.'%')->paginate(8);
        return view('productType', compact('product','key'));
    }

}
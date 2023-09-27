<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $connection = 'mysql';

    //Lấy thông tin tất cả sản phẩm
    public static function allProduct(){
        $allProduct = DB::table('product')->orderBy('product_id','desc')->get();
        $product = $allProduct->simplePaginate(5);
        return $product;
    }

    //Lấy thông tin sản phẩm theo id
    public static function get_product_info_by_id($id){
        $info = DB::table('product')->where('product_id',$id)->get();
        return $info;
    }

    //Lấy ảnh sản phẩm
    public static function get_product_image($id){
        $img = DB::table('product_image')->where('product_id',$id)->where('product_display',1)->get();
        return $img;
    }

    //Trả về các sản phẩm cùng loại
    public static function sameTypeProduct($id){
        $product = DB::table('product')->where('product_id',$id)->get();
        foreach($product as $item){
            $sameTypeProduct = DB::table('product')->where('product_id','!=',$item->product_id)->where('product_type',$item->product_type)->limit(5)->get();
            return $sameTypeProduct;
        }
    }

    //Trả về sản phẩm hay mua cùng
    public static function popWithProduct($id){
        $code = self::getPurchaseCode($id);
        $arr = array();
        foreach($code as $item){
            $productInCode = DB::table('purchase_history')->where('purchaseCode',$item->purchaseCode)->get();
            foreach($productInCode as $i){
                if($i->product_id != $id){
                    array_push($arr,$i->product_id);
                }
            }
        }
        $counts = array_count_values($arr);
        arsort($counts);
        $keys = array_keys($counts);  
        return $keys;
    }

    //Trả về thông tin sản phẩm đi kèm
    public static function infoPop($pop){
        $info = array();
        for($i = 0;$i < count($pop);$i ++){
            $info_id = DB::table('product')->where('product_display',1)->where('product_id',$pop[$i])->get();
            foreach($info_id as $item){
                array_push($info,array($item->product_id,
                                        $item->product_name,
                                        $item->product_price,
                                        $item->product_discount,
                                        $item->product_type,
                                        $item->product_image
                                        ));
            }
        }
        return $info;
    }
    //Trả về kết quả tìm kiếm
    public static function searchResult($searchKey){
        $searchResult = DB::table('product')->where('product_display',1)->where('product_name','like','%'.$searchKey.'%')->get();
        DB::table('search_result')->insert([
            'search_key'=> $searchKey
        ]);
        return $searchResult;
    }

    //Hàm tạo ra mã đơn hàng
    public static function generate_order_id() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 7;
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
          $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $random_string;
    }

    //Hàm trả về các mã đơn hàng của người dùng hiện tại
    public static function getPurchaseCode($id){
        $code = DB::table('purchase_history')->select('purchaseCode')
                        ->distinct()
                        ->where('product_id',$id)
                        ->get();
        return $code;
    }

    //Trả về các sản phẩm trong đơn hàng với đầu vào là mã đơn hàng
    public static function getProductByCode($code){
        $result = DB::table('purchase_history')
                        ->where('user_id',session('curUser'))
                        ->where('purchaseCode',$code)
                        ->get();
        return $result;
    }

    //Trả về đánh giá theo id sản phẩm
    public static function get_comment($id){
        $result = DB::table('comment')
                        ->join('user','user.user_id','=','comment.user_id')
                        ->where('product_id',$id)
                        ->get();
        return $result;
    }
    //Thêm vào giỏ hảng(khi đã đăng nhập)
    public static function addToCart($product_id,$product_quantity){
        DB::table('cart')->insert([
            'user_id' => session('curUser'),
            'product_id' => $product_id,
            'product_num'=>$product_quantity
        ]);
    }

    //Check xem sản phẩm có trong giỏ hàng hay chưa
    public static function checkExistCart($id){
        $result = DB::table('cart')
        ->where('product_id',$id)
        ->where('user_id',session('curUser'))
        ->value('product_id');
        if($result == null){
            return 1;//Chưa xuất hiện trong giỏ hàng
        } else {
            return 0;//Đã xuất hiện trong giỏ hàng
        }
    }

    //Cập nhật số lượng sản phẩm và thêm vào giỏ hàng
    public static function updateQuantity($product_id,$product_quantity){
        $product = DB::table('cart')->where('product_id',$product_id)->where('user_id',session('curUser'))->get();
        foreach($product as $item){
            $item->product_num += $product_quantity;
            DB::table('cart')->where('product_id', '=', $product_id)->where('user_id',session('curUser'))->update(['product_num' => $item->product_num]);
        }
    }

    //Thêm đánh giá
    public static function addComment($comment,$point,$product_id){
        $date = date('Y-m-d H:i:s');
        DB::table('comment')->insert([
            'user_id' => session('curUser'),
            'product_id' => $product_id,
            'comment'=> $comment,
            'ratePoint'=> $point,
            'commentTime' => $date
        ]);
        DB::table('purchase_history')->where('product_id', '=', $product_id)->update(['isEval' => 1]);
    }

    //Cập nhật điểm đánh giá từ trang đánh giá vào trang sản phẩm
    public static function updateAvgPoint($product_id){
        $point = DB::table('comment')->where('product_id',$product_id)->get();
        $sum = 0;
        foreach($point as $item){
            $sum += $item->ratePoint;
        }
        $avg = $sum/(count($point));
        $avg = round($avg,1);
        DB::table('product')->where('product_id', '=', $product_id)->update(['product_rating' => $avg]);
    }
    
    //Xem thông tin giỏ hàng
    public static function viewCart_byID($user_id){
        $cart = DB::table('cart')->where('user_id', '=', $user_id)->orderBy('cart_id','desc')->get();
        $cartArr = array();
        foreach($cart as $item){
            $cartItem  = array($item->cart_id,$item->product_id,$item->product_num);
            array_push($cartArr, $cartItem);
        }
        return $cartArr;
    }

    //Thêm sản phẩm ở giỏ hàng hiện tại
    public static function addCurCart($curCart){
        $cartUser = DB::table('cart')->where('user_id',session('curUser'))->get();
        foreach($cartUser as $item){
            for($i = 0;$i < count($curCart);$i++){
                if($curCart[$i][0] == $item->product_id){
                    $curCart[$i][1] += $item->product_num;
                    DB::table('cart')->where('product_id', '=', $item->product_id)->update(['product_num' => $curCart[$i][1]]);
                } else {
                    DB::table('cart')->insert([
                        'user_id' => session('curUser'),
                        'product_id' => $curCart[$i][0],
                        'product_num' => $curCart[$i][1]
                    ]);
                }  
            }
        }
    }

    //Xóa sản phẩm khỏi giỏ hàng
    public static function removeCartItem($index){
        DB::table('cart')->where('cart_id', $index)->delete();
    }

    //Lịch sử mua hàng
    public static function history(){
        $order = DB::table('order')->where('user_id', '=', session('curUser'))->orderBy('time','desc')->get();
        return $order;
    }

    //Trả về sản phẩm theo phân loại
    public static function productType($key){
        $product = DB::table('product')->where('product_type','like','%'.$key.'%')->get();
        return $product;
    }
} 
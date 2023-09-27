<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use League\CommonMark\Extension\Table\Table;

class AdminController extends Controller
{
    //Trang chủ
    public function index(){
        $admin_info = Admin::adminInfo();
        session()->put('adminInfo',$admin_info);
        return view('admin.index');
    }

    public function userManage(){
        $user = DB::table('user')->where('user_id','!=',session('curUser'))->paginate(6);
        return view('admin.userManage',compact('user'));
    }

    public function changeStatusUser($user_id){
        $user = DB::table('user')->where('user_id',$user_id)->get();
        foreach($user as $item){
            if($item->isAbled == 1){
                DB::table('user')->where('user_id',$user_id)->update(['isAbled'=>0]);
            } else {
                DB::table('user')->where('user_id',$user_id)->update(['isAbled'=>1]);
            }
        }
        return Redirect::to('admin/userManage');
    }

    public function productManage(){
        $product = DB::table('product')->paginate(10);
        return view('admin.productManage',compact('product'));
    }
    public function productDisplay($product_id){
        $product = DB::table('product')->where('product_id',$product_id)->get();
        foreach($product as $item){
            if($item->product_display == 1){
                DB::table('product')->where('product_id',$product_id)->update(['product_display'=>0]);
            } else {
                DB::table('product')->where('product_id',$product_id)->update(['product_display'=>1]);
            }
        }
        return Redirect::to('admin/productManage'); 
    }

    public function updateProduct($product_id){
        $product = DB::table('product')->where('product_id',$product_id)->get();
        return view('admin.updateProduct', compact('product'));
    }

    public function handleUpdateProduct(Request $request){
        DB::table('product')->where('product_id',$request->productId)
            ->update([
                'product_name'=>$request->productName,
                'product_image'=>$request->productImage,
                'product_detail'=>$request->productDetail,
                'product_discount'=>$request->productDiscount,
                'product_type'=>$request->productType,
                'product_available'=>$request->productAvailable
            ]);
        return Redirect::to('admin/productManage');
    }

    public function addProduct(){
        return view('admin.addProduct');
    }
    public function handleAddProduct(Request $request){
        DB::table('product')->insert([
            'product_name'=>$request->aproductName,
            'product_price'=>$request->aproductPrice,
            'product_type'=>$request->aproductType,
            'product_discount'=>$request->aproductDiscount,
            'product_available'=>$request->aproductAvailable,
            'product_detail'=>$request->aproductDetail,
            'product_rating'=>0,
            'product_sold'=>0,
            'product_image'=>$request->aproductImage,
            'product_display'=>1
        ]);
        return Redirect::to('/admin/productManage');
    }

    public function logout(){
        session()->flush();
        return Redirect('/login');
    }

    public function orderManage(){
        $order = DB::table('order')->where('isReceive',0)->paginate(8);
        return view('admin.orderManage',compact('order'));
    }

    public function orderDetail($code){
        $productInOrder = DB::table('purchase_history')->join('product','product.product_id','=','purchase_history.product_id')->where('purchaseCode',$code)->paginate(5);
        return view('admin.orderDetail',compact('productInOrder','code'));
    }

    public function acceptOrder($code){
        DB::table('order')->where('orderCode',$code)->update(['isReceive'=>1]);
        return Redirect::to('/admin/orderManage');
    }

    public function historyManage(){
        $order = DB::table('order')->where('isReceive',1)->paginate(8);
        return view('admin.historyManage',compact('order'));
    }
}
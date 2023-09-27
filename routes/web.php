<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    // session_destroy();
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('register');
});
//Trang chủ
Route::get('/', [UserController::class, 'homepage']);
Route::get('/demo', [UserController::class, 'index']);
//Đăng nhập
Route::post('/login',[UserController::class, 'login']);
//Đăng ký
Route::post('/register',[UserController::class, 'register']);
//Đăng xuất
Route::get('/logout',[UserController::class, 'logout']);
//Xem thông tin sản phẩm
Route::get('/product_info/{id}',[UserController::class, 'get_product_info']);
//Xem thông tin người dùng hiện tại
Route::get('/userInfo',[UserController::class, 'userInfo']);
//Cập nhật thông tin người dùng
Route::get('/updateInfo', [UserController::class, 'updateInfo']);
//Xử lí cập nhật thông tin
Route::post('/updateInfo',[UserController::class, 'handle_updateInfo']);
//Đổi mật khẩu
Route::get('/changePassword',[UserController::class, 'changePassword']);
//Xử lí đổi mật khẩu
Route::post('/changePassword',[UserController::class, 'handle_changePassword']);
//Thêm sản phẩm vào giỏ hàng
Route::post('/addToCart',[UserController::class, 'addToCart']);
//Kết quả tìm kiếm
Route::post('/search_result',[UserController::class, 'searchResult']);
Route::get('/search_result',[UserController::class, 'searchResult']);
Route::get('/search/{key}',[UserController::class, 'search']);
Route::get('/productType/{key}',[UserController::class, 'productType']);
//Xem lịch sử mua hàng
Route::get('/purchaseHistory',[UserController::class, 'purchaseHistory']);
//Xem giỏ hàng
Route::get('/viewCart',[UserController::class, 'viewCart']);
//Xóa sản phẩm khỏi giỏ hàng
Route::get('/removeFromCart/{i}',[UserController::class, 'removeFromCart']);
//Mua hàng
Route::post('/purchase',[UserController::class, 'purchase']);
//Xem lịch sử mua hàng
Route::get('/history',[UserController::class, 'history']);
//Nhận hàng
Route::get('/received/{code}',[UserController::class, 'received']);
//Đánh giá sản phẩm
Route::get('/evaluate/{id}',[UserController::class,'evaluateForm']);
//Xử lí đánh giá sản phẩm
Route::post('/evaluate_handle',[UserController::class,'evaluate_handle']);

//ADMIN
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class,'index']);
    Route::get('/userManage', [AdminController::class,'userManage']);
    Route::get('/changeStatusUser/{user_id}', [AdminController::class,'changeStatusUser']);
    Route::get('/productManage', [AdminController::class,'productManage']);
    Route::get('/display/{product_id}', [AdminController::class,'productDisplay']);
    Route::get('/updateProduct/{product_id}',[AdminController::class,'updateProduct']);
    Route::post('/updateProduct',[AdminController::class,'handleUpdateProduct']);
    Route::get('/addProduct',[AdminController::class,'addProduct']);
    Route::post('/addProduct',[AdminController::class,'handleAddProduct']);
    Route::get('/orderManage',[AdminController::class,'orderManage']);
    Route::get('/orderDetail/{orderCode}',[AdminController::class,'orderDetail']);
    Route::get('/acceptOrder/{code}',[AdminController::class,'acceptOrder']);
    Route::get('/historyManage',[AdminController::class,'historyManage']);

    Route::get('/logout',[AdminController::class,'logout']);

});
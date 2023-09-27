<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'address',
        'phone'
    ];
    protected $timestamp = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    //Đăng ký
    public static function addUser(Request $request){
        
        $name = $request->fullname;
        $phone = $request->phone;
        $address = $request->address;
        $password = $request->password;
        $confirm_pass = $request->confirmPassword;
        $allphone = DB::table('user')->where('phone',$phone)->value('phone');
        if($allphone != null){ 
            return 2;
        } else {
            if($password == $confirm_pass){
                DB::table('user')->insert([
                    'username' => $name,
                    'password' => md5($password),
                    'address' => $address,
                    'phone' => $phone,
                    'role' => 2,
                    'isAbled' => 1
                ]);
                return 1;
            } else {
                return 0;
            }
        }      
    }

    //Đăng nhập
    public static function login(Request $request){
        $phone = $request->phone;
        $pass  = md5($request->password);
        $isAbled = DB::table('user')->where('phone', $phone)->value('isAbled');
        
        $realPass = DB::table('user')->where('phone', $phone)->value('password');
        if($pass === $realPass){
            if($isAbled == 0){
                return 3;
            }
            $role = DB::table('user')->where('phone', $phone)->value('role');
            if($role == 1){
                $name = DB::table('user')->where('phone', $phone)->value('username');
                $user_id = DB::table('user')->where('phone', $phone)->value('user_id');
                $user_role = DB::table('user')->where('phone', $phone)->value('role');
                $request->session()->put(['curAccess' => $name]);
                $request->session()->put(['curUser' => $user_id]);
                $request->session()->put(['curRole' => $user_role]);
                return 1;
            }
            else {
                $name = DB::table('user')->where('phone', $phone)->value('username');
                $user_id = DB::table('user')->where('phone', $phone)->value('user_id');
                $request->session()->put(['curAccess' => $name]);
                $request->session()->put(['curUser' => $user_id]);
                return 2;
            }
        } else {
            return 0;
        }
    }

    //Đăng xuất
    public static function logout(){
        session()->flush();
    }


    //Kiểm tra số điện thoại
    public static function checkPhone($phone){
        $allphone = DB::table('user')->where('phone',$phone)->get();
        if(count($allphone) > 1){ 
            return 2;
        } else {
            return 1;
        }      
    }

    //Cập nhật thông tin người dùng
    public static function update_userInfo($username, $phone, $address, $email){
        $user_id = session('curUser');
        DB::table('user')
            ->where('user_id', $user_id)
            ->update(['username' => $username,
                        'phone' => $phone,
                        'address' => $address,
                        'email' => $email
        ]);
    }

    //Xem thông tin người dùng
    public static function user_info($user_id){
        $info = DB::table('user')->where('user_id', $user_id)->get();
        return $info;
    }

    //Xem lịch sử mua hàng
    public static function purchase_history(){

    }

    //Cập nhật góp ý về trang web
    public function contribution(){

    }

    //Đổi mật khẩu
    public static function changePass($password,$newPass){
        $user_id = session('curUser');
        $pass = DB::table('user')->where('user_id', $user_id)->value('password');
        if($pass == md5($password)){
            DB::table('user')
            ->where('user_id', $user_id)
            ->update(['password' => md5($newPass)]);
            return 1;
        } else {
            return 0;
        }

    }
}
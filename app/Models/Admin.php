<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Admin extends Model
{
    use HasFactory;
    public static function adminInfo(){
        $adminInfo = DB::table('user')->where('user_id',session('curUser'))->get();
        return $adminInfo;
    }
}

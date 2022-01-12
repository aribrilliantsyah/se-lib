<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthCommon {

    function __construct(){ }

    public static function check_credential($credential){
        if(Auth::attempt($credential)){
            return true;
        }else{
            return false;
        }
    }

    public static function do_register($user){
        $created = User::firstOrCreate($user);
        return $created;
    }

    public static function user(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return $user;
    }

    public static function logout(){
        Auth::logout();
        return true;
    }
}

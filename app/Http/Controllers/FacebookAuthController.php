<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{

    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callbackFacebook(){
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            // $user = User::where('')
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}

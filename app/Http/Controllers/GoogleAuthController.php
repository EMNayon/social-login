<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(){
        // dd('okay');
        // $social =  Socialite::driver('google')->redirect();
        // dd($social);
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        try {
            $google_user = Socialite::driver('google')->user();
            // dd($google_user);
            $user = User::where('provider_id', $google_user->getId())->first();

            if(!$user){
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'provider_id' => $google_user->getId(),
                    // 'avater' => $google_user->getAvater(),
                ]);
                Auth::login($new_user);
                return redirect()->intended('dashboard');
            }else {
                Auth::login($user);
                return redirect()->intended('dashboard');
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd('Something went wrong! ' . $th->getMessage());
        }
    }
}

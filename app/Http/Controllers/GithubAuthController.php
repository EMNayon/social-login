<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('github')->redirect();
    }
    public function callbackGithub(){
        try {
            $github_user = Socialite::driver('github')->user();

            $user = User::where('provider_id', $github_user->getId())->first();

            if(!$user){
                $new_user = User::create([
                    'name' => $github_user->getName(),
                    'email' => $github_user->getEmail(),
                    'provider_id' => $github_user->getId(),
                    // 'avater ' => $github_user->getAvater()
                ]);
                Auth::login($new_user);
                return redirect()->intended('dashboard');
            }else {
                Auth::login($user);
                return redirect()->intended('dashboard');
            }
            // dd($github_user);
            // Auth::login($github_user);
            // return redirect()->intended('dashboard');
            // $user = User::where('')
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
}

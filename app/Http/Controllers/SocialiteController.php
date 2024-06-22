<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    //
    // public function login(){
    //     return Socialite::driver('github')->redirect();    
    // }
    // public function redirect()
    // {
    //     $user=Socialite::driver('github')->user();
    //     dd($user);
    // }
    public function toprovider($driver){
        return  Socialite::driver($driver)->redirect();
    }
    public function handelCallback($driver){
        // dd($driver);
        $user = Socialite::driver($driver)->User();
        $user = User::updateOrCreate(['email'=>$user->getEmail(),],['provider_id'=>$user->getId(),'name'=>$user->getName(),]);
        // $user = User::create([]);

        Auth::login($user,True);
        return to_route('dashboard');
    }
}

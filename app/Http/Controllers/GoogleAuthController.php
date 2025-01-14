<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function GoogleAuthRoute(){
        return Socialite::driver('google')->redirect();
    }

    public function GoogleAuthCallback(){
        $googleUser = Socialite::driver('google')->user();

        // dd($googleUser);

        $user = User::where('google_id', $googleUser->id)->first();

        if($user){
            Auth::login($user);
            return redirect()->route('dashboard');
        }else{
            $checkInset = User::create([
                'google_id' => $googleUser->id,
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make('password'),
            ]);

            if($checkInset){
                Auth::login($checkInset);
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('login');
            }
        }
    }
}

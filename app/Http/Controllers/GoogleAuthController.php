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
}

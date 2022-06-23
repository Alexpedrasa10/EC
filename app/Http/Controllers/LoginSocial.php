<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginSocial extends Controller
{


    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }
    
    public function login ($driver)
    {
        $user = Socialite::driver($driver)->stateless()->user();

        $auth = User::firstOrCreate([
            'name' => $user->getName(),
            'email' => !is_null($user->getEmail()) ? $user->getEmail() : 'queculiau@gmail.com',
            'current_team_id'=> 2
        ]);
    
        Auth::login($auth);
        return back();
    }

}

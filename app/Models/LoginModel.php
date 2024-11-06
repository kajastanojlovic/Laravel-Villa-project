<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginModel extends Model
{
    use HasFactory;

    public function login(Request $request)
    {
        $pass = $request->password;

        $email = $request->get('email');

        $user = User::where('email',$email)->first();

        if(!$user)
        {
            return redirect()->route('login.create')->with('error', 'Wrong credentials.');
        }
        if (!Hash::check($pass,$user->password)) {

            return redirect()->route('login.create')->with('error', 'Wrong credentials');
        }
        //dd($user);
        Auth::login($user);

        //$request->session()->put('user', $user);
    }
}

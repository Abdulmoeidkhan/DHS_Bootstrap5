<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    protected function isActivated($req)
    {
        $user = User::where('email', $req->email)->first();
        return $user->activated;
    }
    public function signIn(Request $req)
    {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($this->isActivated($req)) {
            if (Auth::attempt($credentials)) {
                $req->session()->regenerate();
                return User::with('roles')->where('email', $req->email)->first();
            } else {
                return ['status' => 0, "msg" => 'The provided credentials do not match our records.'];
            }
        } else {
            return "User is not activated";
        }
    }
}

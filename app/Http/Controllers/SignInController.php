<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    protected function isActivated($req)
    {
        $user = User::where('email', $req->email)->first();
        return $user ? $user->activated : false;
    }
    protected function isAvailable($req)
    {
        $user = User::where('email', $req->email)->first();
        return $user ? true : false;
    }
    public function signIn(Request $req)
    {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if ($this->isAvailable($req)) {

            if ($this->isActivated($req)) {
                if (Auth::attempt($credentials)) {
                    $req->session()->regenerate();
                    $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
                    $user->images = Image::where('uid', Auth::user()->uid)->first();
                    session()->put('user', $user);
                    return redirect()->route('pages.dashboard')->with('message', "You have successfully Signed In")->with('flash_message', "If you need to install this App please click below");
                    // return User::with('roles')->where('email', $req->email)->first();
                } else {
                    // return ['status' => 0, "msg" => 'The provided credentials do not match our records.'];
                    return back()->with('error', "Password credentials do not match our records.");
                }
            } else {
                return redirect()->route('accountActivation')->with('error', "User is not activated");
            }
        } else {
            return back()->with('error', "User does not exist");
        }
    }
}

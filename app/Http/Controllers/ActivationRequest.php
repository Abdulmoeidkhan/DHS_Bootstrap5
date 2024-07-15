<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivationRequest extends Controller
{
    protected function badge($characters, $prefix)
    {
        $possible = '0123456789';
        $code = $prefix;
        $i = 0;
        while ($i < $characters) {
            $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if ($i < $characters - 1) {
                $code .= "";
            }
            $i++;
        }
        return $code;
    }

    public function activation(Request $req)
    {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        try {
            $userVerified = Auth::attempt($credentials);
            if ($userVerified) {
                $user = Auth::user();
                if ($user->activation_code == $req->activationCode) {
                    $activated = User::where("id", $user->id)->update(['activated' => 1]);
                    $req->session()->regenerate();
                    $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
                    $user->images = Image::where('uid', Auth::user()->uid)->first();
                    session()->put('user', $user);
                    // return redirect()->route('pages.dashboard')->with('message', "You have successfully Signed In")->with('flash_message', "If you need to install this App please click below");
                    // Auth::logout();
                    return $activated ? redirect()->route('pages.profileActivation')->with('message', 'Profile has been activated') : redirect()->back()->with('error', 'Something Went Wrong');
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'Activation Code is not correct');
                }
            } else {
                return redirect()->back()->with('error', 'Email/Password is not correct');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function resendOtp(Request $req)
    {
    }
}

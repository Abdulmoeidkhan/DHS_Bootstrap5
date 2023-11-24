<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivationRequest extends Controller
{

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
                    Auth::logout();
                    return $activated ? redirect()->route('signIn')->with('message', 'Profile has been activated') : back()->with('error', 'Something Went Wrong');
                } else {
                    Auth::logout();
                    return back()->with('error', 'Activation Code is not correct');
                }
            } else {
                return back()->with('error', 'Email/Password is not correct');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
}

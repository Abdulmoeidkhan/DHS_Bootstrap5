<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function renderView(Request $req)
    {
        // $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
        // $permission = Permission::where('name', 'read')->first();
        // // $user->attachPermission($permission);
        // $user->givePermission($permission);
        session()->put('user', User::with('roles', 'permissions')->where('id', Auth::user()->id)->first());
        return view('pages.dashboard');
        // return User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
    }
}

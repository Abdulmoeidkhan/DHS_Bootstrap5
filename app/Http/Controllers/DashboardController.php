<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function renderView(Request $req)
    {
        // $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
        // $permission = Permission::where('name', 'read')->first();
        // // $user->attachPermission($permission);
        // $user->givePermission($permission);
        // return session()->get('user');
        return view('pages.dashboard');
        // return User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
    }
}

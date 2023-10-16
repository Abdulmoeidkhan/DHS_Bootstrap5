<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPanelController extends Controller
{
    public function renderView(Request $req)
    {
        $users = User::with('roles')->where('id', '!=', Auth::user()->id)->get();
        // return $users;
        return view('pages.userPanel', ['users' => $users]);
    }
}

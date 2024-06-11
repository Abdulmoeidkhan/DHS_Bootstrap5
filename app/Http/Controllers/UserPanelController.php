<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Models\Delegate;
// use App\Models\Delegation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPanelController extends Controller
{
    public function render(Request $req)
    {
        $users = User::with('roles')->where('id', '!=', Auth::user()->id)->get();
        // return $users;
        return view('pages.userPanel', ['users' => $users]);
        foreach ($users as $key => $user) {
            switch ($user->roles[0]->name) {
                case "delegate":
                    // $users[$key]->generalInfo=Delegation::where('uid',Delegate::where('delegates_uid',$user->uid)->first())->first();
                    break;
                case "receiving":
                    
                    break;
                case "hotels":
                    
                    break;
                case "airport":
                    
                    break;
            }
        }

    }
}

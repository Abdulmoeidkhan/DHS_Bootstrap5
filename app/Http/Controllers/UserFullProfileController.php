<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;
use Laratrust\Models\Role;
use Laratrust\Models\Permission;

class UserFullProfileController extends Controller
{
    public function render(Request $req, $id)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $user = User::with('roles', 'permissions')->where('uid', $id)->first();
        $image = Image::where('uid', $id)->first();
        $user->images = $image;
        return view('pages.userProfile', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions]);
    }
    public function renderMyProfile(Request $req)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $user = session()->get('user');
        return view('pages.userProfile', ['user' => $user,  'roles' => $roles, 'permissions' => $permissions]);
    }
    public function renderDelegateProfile(){
        $delegate=Delegate::where('user_uid', auth()->user()->uid)->first();
        return view('pages.delegateProfile',['delegate'=>$delegate]);
    }
}

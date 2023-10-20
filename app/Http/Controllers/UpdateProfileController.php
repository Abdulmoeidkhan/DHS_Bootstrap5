<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogoutController;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laratrust\Models\Role;
use Laratrust\Models\Team;
use Laratrust\Models\Permission;


class UpdateProfileController extends Controller
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
    public function updateProflie(Request $req)
    {
        User::where('uid', $req->uid)->update(['name' => $req->inputUserName, 'contact_number' => $req->inputContactNumber]);
        $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
        $user->images = Image::where('uid', Auth::user()->uid)->first();
        session()->forget('user');
        session()->put('user', $user);
        return "Profile has been updated";
    }

    public function updateAuthority(Request $req)
    {
        $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
        $roleToBeAdd = Role::where('name', $req->roles)->first();
        $teamToBeAdd = Team::where('name', $req->roles)->first();
        $rolesRemoved = $user->removeRole($user->roles[0], $user->roles[0]);
        $rolesAdded = $user->addRole($roleToBeAdd, $teamToBeAdd);
        $permissions = Permission::all();
        foreach($permissions as $permission){

        }
        // $permissionsRemoved = $user->removePermissions($user->permissions);
        // $permissionsAdded = $user->givePermissions();
        // if ($rolesRemoved) {
        // }
        // return [$roleToBeAdd, $roleToBeDelete, $teamToBeAdd, $teamToBeRemove];
        // $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
        return [$req->all(), $user,$permissions];
        // return [$rolesRemoved, $rolesAdded];

        // $user->images = Image::where('uid', Auth::user()->uid)->first();
        // session()->forget('user');
        // session()->put('user', $user);
        // return "Profile has been updated";
    }
    public function updatePassword(Request $req)
    {
        $password = Hash::make($req->userInputPassword);
        $activation_code = $this->badge(8, "");
        User::where('uid', $req->uid)->update(['password' => $password, 'activation_code' => $activation_code, 'activated' => 0]);
        return "Profile has been updated";
        // return redirect()->route('logout.request');
        // $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
        // $user->images = Image::where('uid', Auth::user()->uid)->first();
        // session()->forget('user');
        // session()->put('user', $user);
        // return true;
    }
}

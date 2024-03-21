<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Laratrust\Models\Role;
use Laratrust\Models\Team;
use Laratrust\Models\Permission;

class SignUpController extends Controller
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
    protected function basicRolesAndTeams($user)
    {
        $team = Team::where('name', 'user')->first();
        $role = Role::where('name', 'user')->first();
        $permission = Permission::where('name', 'read')->first();
        $user->addRole($role, $team);
        $user->givePermission($permission, $team);
        // $user->addRole('admin', 'admin');
        // $user->givePermissions(['read', 'create', 'update', 'delete'], 'admin');
    }

    public function signUp(Request $req)
    {
        $uid = (string) Str::uuid();
        $user = new User();
        $user->uid = $uid;
        $user->name = $req->username;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->activation_code = $this->badge(8, "");
        $savedUser = 0;
        try {
            $savedUser = $user->save();
            $this->basicRolesAndTeams($user);
            if ($savedUser) {
                $emailSent = (new MailOtpController)->html_email($uid);
                return $emailSent ? redirect()->route("accountActivation") : redirect()->back()->with('error', 'Email Address already Exist error : ');
                // return redirect()->route('request.emailModule',$uid);
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[2]) {
                // return  $exception->errorInfo[2];
                return  redirect()->back()->with('error', 'Email Address already Exist error : ' . $exception->errorInfo[2]);
            } else {
                return  redirect()->back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
};

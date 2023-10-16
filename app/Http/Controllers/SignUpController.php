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
        $user->givePermission($permission,$team);
        // $user->addRole('admin', 'admin');
        // $user->givePermissions(['read','create','update','delete'],'admin');
    }

    public function signUp(Request $req)
    {
        $resp = 0;
        $user = new User();
        $user->uid = (string) Str::uuid();
        $user->name = $req->username;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->activation_code = $this->badge(8, "");
        $savedUser = 0;
        try {
            $savedUser = $user->save();
            $this->basicRolesAndTeams($user);
            if ($savedUser) {
                return redirect()->route("accountActivation");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[2]) {
                // return  $exception->errorInfo[2];
                return  back()->with('error', "Email Address already Exist error : $exception->errorInfo[2]");
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
};

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Delegate;
use App\Models\Delegation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laratrust\Models\Role;
use Laratrust\Models\Team;
use Laratrust\Models\Permission;

class ActivateProfileController extends Controller
{
    protected function activateDelegate($recievedParams)
    {
        $delegate = new Delegate();
        $delegationUid = Delegation::where('delegationCode', 'DL' . $recievedParams->activationCode . '')->first();
        $delegate->uid = (string) Str::uuid();
        $delegate->user_uid = $recievedParams->uid;
        $delegate->delegation = $delegationUid->uid;
        try {
            $savedDelegate = $delegate->save();
            $updatesDone = $savedDelegate ? Delegation::where('delegationCode', 'DL' . $recievedParams->activationCode . '')->update(['delegates' => $recievedParams->uid]) : false;
            return $updatesDone;
            // return $savedDelegate;
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
    protected function delegationRolesAndTeams($uid)
    {
        $team = Team::where('name', 'delegate')->first();
        $role = Role::where('name', 'delegate')->first();
        $user = User::with('roles', 'permissions')->where('uid', $uid)->first();
        $rolesRemoved = $user->removeRole($user->roles[0], $user->roles[0]);
        $rolesAdded = $user->addRole($role, $team);
        $oldPermissions = $user->givePermissions(['read', 'create'], $team);
        // $user->addRole('admin', 'admin');
        // $user->givePermissions(['read', 'create', 'update', 'delete'], 'admin');
    }
    public function activateProfile(Request $req)
    {
        switch ($req->prefixSelect) {
            case "DL":
                $delegateActivated = $this->activateDelegate($req);
                $delegateRolesPermission = $this->delegationRolesAndTeams($req->uid);
                // return $this->activateDelegate($req);
                return $delegateActivated ? back()->with('message', 'Delegation Updated Successfully') : "Not Working";
                break;
            case "blue":
                echo "Your favorite color is blue!";
                break;
            case "green":
                echo "Your favorite color is green!";
                break;
            default:
                return back()->with('error', 'Something Went Wrong');
        }
    }
}
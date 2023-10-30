<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Delegate;
use App\Models\Delegation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laratrust\Models\Role;
use Laratrust\Models\Team;
use App\Models\Image;
use Laratrust\Models\Permission;

class ActivateProfileController extends Controller
{
    protected function activateDelegate($recievedParams)
    {
        $delegationUid = Delegation::where([['delegationCode', $recievedParams->activationCode . ''], ['delegates', null]])->first();
        if ($delegationUid) {
            $delegate = new Delegate();
            $delegate->uid = (string) Str::uuid();
            $delegate->user_uid = $recievedParams->uid;
            $delegate->delegation = $delegationUid->uid;
            try {
                $savedDelegate = $delegate->save();
                $updatesDone = $savedDelegate ? Delegation::where('delegationCode', $recievedParams->activationCode . '')->update(['delegates' => $recievedParams->uid, 'delegation_response' => 'accepted']) : false;
                $rolesAndPermissionGiven = $updatesDone ? $this->delegationRolesAndTeams($recievedParams->uid) : false;
                return $rolesAndPermissionGiven;
            } catch (\Illuminate\Database\QueryException $exception) {
                if ($exception->errorInfo[2]) {
                    return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
                } else {
                    return  back()->with('error', $exception->errorInfo[2]);
                }
            }
        } else {
            return false;
        }
    }
    protected function delegationRolesAndTeams($uid)
    {
        $team = Team::where('name', 'delegate')->first();
        $role = Role::where('name', 'delegate')->first();
        $user = User::with('roles', 'permissions')->where('uid', $uid)->first();
        $oldPermissions = $user->permissions;
        foreach ($oldPermissions as $oldPermission) {
            $user->removePermission($oldPermission, $user->roles[0]);
        }
        $rolesRemoved = $user->removeRole($user->roles[0], $user->roles[0]);
        $rolesAdded = $user->addRole($role, $team);
        $newdPermissions = $user->givePermissions(['read', 'create'], $team);
        $updatedUser = User::with('roles', 'permissions')->where('uid', $uid)->first();
        $updatedUser->images=Image::where('uid', $uid)->first();
        session()->forget('user');
        session()->put('user', $updatedUser);
        return true;
        // $user->addRole('admin', 'admin');
        // $user->givePermissions(['read', 'create', 'update', 'delete'], 'admin');
    }
    public function activateProfile(Request $req)
    {
        $prefixSelect = substr(trim($req->activationCode), 0, 2);
        switch ($prefixSelect) {
            case "DL":
                $delegateActivated = $this->activateDelegate($req);
                // return $delegateActivated;
                // $delegateRolesPermission = $this->delegationRolesAndTeams($req->uid);
                return $delegateActivated ? back()->with('message', 'Delegation Updated Successfully') : back()->with('error', 'Delegation already assigned');
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
    public function renderProfileActivation()
    {
        $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
        return view('pages.profileActivation', ['user' => $user]);
    }
}

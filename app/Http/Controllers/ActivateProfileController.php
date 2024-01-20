<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Liason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laratrust\Models\Role;
use Laratrust\Models\Team;
use App\Models\Image;
use App\Models\Interpreter;
use App\Models\Receiving;
use Laratrust\Models\Permission;

class ActivateProfileController extends Controller
{
    protected function activateDelegate($recievedParams)
    {
        $delegationUid = Delegation::where([['delegationCode', $recievedParams->activationCode . '']])->first();
        if ($delegationUid) {
            // $delegate = new Delegate();
            // $delegate->user_uid = $recievedParams->uid;
            // $delegate->delegation = $delegationUid->uid;
            try {
                $delegateClaim = Delegation::where('uid', $delegationUid->uid)->update(['user_uid' => Auth::user()->uid]);
                // $savedDelegate = Delegation::where('delegates_uid', $delegationUid->uid)->update(['user_uid' => $recievedParams->uid]);
                $updatesDone = $delegateClaim ? Delegation::where('delegationCode', $recievedParams->activationCode . '')->update(['delegation_response' => 'Accepted']) : false;
                $rolesAndPermissionGiven = $updatesDone ? $this->delegationRolesAndTeams($recievedParams->uid,$delegationUid) : false;
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
    protected function delegationRolesAndTeams($uid,$delegationUid)
    {
        $team = Team::where('name', 'delegate')->first();
        $role = Role::where('name', 'delegate')->first();
        $user = User::with('roles', 'permissions')->where('uid', $uid)->first();
        $oldPermissions = $user->permissions;
        foreach ($oldPermissions as $oldPermission) {
            $user->removePermission($oldPermission, $user->roles[0]);
        }
        $user->removeRole($user->roles[0], $user->roles[0]);
        $user->addRole($role, $team);
        $user->givePermissions(['read', 'create'], $team);
        $updatedUser = User::with('roles', 'permissions')->where('uid', $uid)->first();
        $updatedUser->images = Image::where('uid', $uid)->first();
        $updatedUser->delegationUid= $delegationUid->uid;
        session()->forget('user');
        session()->put('user', $updatedUser);
        return true;
        // $user->addRole('admin', 'admin');
        // $user->givePermissions(['read', 'create', 'update', 'delete'], 'admin');
    }


    protected function activateLiason($recievedParams)
    {
        $liasonData = Liason::where([['liasonCode', $recievedParams->activationCode], ['liason_officer', null]])->first();
        if ($liasonData) {
            try {
                $updateLiason = Liason::where([['liasonCode', $recievedParams->activationCode . ''], ['liason_officer', null]])->update(['liason_officer' => session()->get('user')->uid]);
                $rolesAndPermissionGiven = $updateLiason ? $this->liasonRolesAndTeams($recievedParams->uid) : false;
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

    protected function activateReceiving($recievedParams)
    {
        $receivingData = Receiving::where([['receivingCode', $recievedParams->activationCode], ['receiving_officer', null]])->first();
        if ($receivingData) {
            try {
                $updateReceiving = Receiving::where([['receivingCode', $recievedParams->activationCode . ''], ['receiving_officer', null]])->update(['receiving_officer' => session()->get('user')->uid]);
                $rolesAndPermissionGiven = $updateReceiving ? $this->receivingRolesAndTeams($recievedParams->uid) : false;
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

    protected function activateInterpreter($recievedParams)
    {
        $receivingData = Interpreter::where([['interpreterCode', $recievedParams->activationCode], ['interpreter_assign', 0]])->first();
        if ($receivingData) {
            try {
                $updateReceiving = Interpreter::where([['interpreterCode', $recievedParams->activationCode . ''], ['interpreter_assign', 0]])->update(['interpreter_assign' => session()->get('user')->uid]);
                $rolesAndPermissionGiven = $updateReceiving ? $this->interpreterRolesAndTeams($recievedParams->uid) : false;
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

    protected function receivingRolesAndTeams($uid)
    {
        $team = Team::where('name', 'receiving')->first();
        $role = Role::where('name', 'receiving')->first();
        $user = User::with('roles', 'permissions')->where('uid', $uid)->first();
        $oldPermissions = $user->permissions;
        $rolesRemoved = $user->removeRole($user->roles[0], $user->roles[0]);
        foreach ($oldPermissions as $oldPermission) {
            $user->removePermission($oldPermission, $user->roles[0]);
        }
        if ($rolesRemoved) {
            try {
                $rolesAdded = $user->addRole($role, $team);
                $newdPermissions = $user->givePermissions(['read', 'create'], $team);
                $updatedUser = User::with('roles', 'permissions')->where('uid', $uid)->first();
                $updatedUser->images = Image::where('uid', $uid)->first();
                session()->forget('user');
                session()->put('user', $updatedUser);
                return true;
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

    protected function interpreterRolesAndTeams($uid)
    {
        $team = Team::where('name', 'interpreter')->first();
        $role = Role::where('name', 'interpreter')->first();
        $user = User::with('roles', 'permissions')->where('uid', $uid)->first();
        $oldPermissions = $user->permissions;
        $rolesRemoved = $user->removeRole($user->roles[0], $user->roles[0]);
        foreach ($oldPermissions as $oldPermission) {
            $user->removePermission($oldPermission, $user->roles[0]);
        }
        if ($rolesRemoved) {
            try {
                $rolesAdded = $user->addRole($role, $team);
                $newdPermissions = $user->givePermissions(['read', 'create'], $team);
                $updatedUser = User::with('roles', 'permissions')->where('uid', $uid)->first();
                $updatedUser->images = Image::where('uid', $uid)->first();
                session()->forget('user');
                session()->put('user', $updatedUser);
                return true;
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
    protected function liasonRolesAndTeams($uid)
    {
        $team = Team::where('name', 'liason')->first();
        $role = Role::where('name', 'liason')->first();
        $user = User::with('roles', 'permissions')->where('uid', $uid)->first();
        $oldPermissions = $user->permissions;
        $rolesRemoved = $user->removeRole($user->roles[0], $user->roles[0]);
        foreach ($oldPermissions as $oldPermission) {
            $user->removePermission($oldPermission, $user->roles[0]);
        }
        if ($rolesRemoved) {
            try {
                $rolesAdded = $user->addRole($role, $team);
                $newdPermissions = $user->givePermissions(['read', 'create'], $team);
                $updatedUser = User::with('roles', 'permissions')->where('uid', $uid)->first();
                $updatedUser->images = Image::where('uid', $uid)->first();
                session()->forget('user');
                session()->put('user', $updatedUser);
                return true;
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
            case "LO":
                $liasonActivated = $this->activateLiason($req);
                return $liasonActivated ? back()->with('message', 'Liason Updated Successfully') : back()->with('error', 'Liason already assigned');
                break;
            case "RO":
                $receivingActivated = $this->activateReceiving($req);
                return $receivingActivated ? back()->with('message', 'Receiving Updated Successfully') : back()->with('error', 'Receiving already assigned');
                break;
            case "IO":
                $interpreterActivated = $this->activateInterpreter($req);
                return $interpreterActivated ? back()->with('message', 'Receiving Updated Successfully') : back()->with('error', 'Receiving already assigned');
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

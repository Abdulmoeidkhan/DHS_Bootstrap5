<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Hotel;
use App\Models\HotelOperator;
use App\Models\Liason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laratrust\Models\Role;
use Laratrust\Models\Team;
use App\Models\Image;
use App\Models\ImageBlob;
use App\Models\Interpreter;
use App\Models\Officer;
use App\Models\Receiving;
use Laratrust\Models\Permission;

class ActivateProfileController extends Controller
{

    protected function activateHotelOperator($recievedParams)
    {
        $hotel = Hotel::where([['hotel_code', $recievedParams->activationCode . '']])->first();
        if ($hotel) {
            $assignOperator = new HotelOperator();
            $assignOperator->hotel_operator_uid  = (string) Str::uuid();
            $assignOperator->hotel_uid = $hotel->hotel_uid;
            $assignOperator->hotel_code  = $hotel->hotel_code;
            $assignOperator->hotel_operator_assign = 1;
            $assignOperator->hotel_operator_user  = Auth::user()->uid;
            $assignOperator->hotel_operator_status = 1;
            try {
                $operatorSaved = $assignOperator->save();
                return $operatorSaved;
                // $rolesAndPermissionGiven = $operatorSaved ? $this->operatorRolesAndTeams($assignOperator->hotel_operator_user) : false;
                // return $rolesAndPermissionGiven;
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

    protected function operatorRolesAndTeams($uid)
    {
        $team = Team::where('name', 'hotels')->first();
        $role = Role::where('name', 'hotels')->first();
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


    protected function activateDelegate($recievedParams)
    {
        $delegationUid = Delegation::where([['delegationCode', $recievedParams->activationCode . '']])->first();
        if ($delegationUid) {
            try {
                $delegateClaim = Delegation::where('uid', $delegationUid->uid)->update(['user_uid' => Auth::user()->uid]);
                $updatesDone = $delegateClaim ? Delegation::where('delegationCode', $recievedParams->activationCode . '')->update(['delegation_response' => 'Accepted']) : false;
                $rolesAndPermissionGiven = $updatesDone ? $this->delegationRolesAndTeams($recievedParams->uid, $delegationUid) : false;
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
    protected function delegationRolesAndTeams($uid, $delegationUid)
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
        $updatedUser->delegationUid = $delegationUid->uid;
        session()->forget('user');
        session()->put('user', $updatedUser);
        return true;
        // $user->addRole('admin', 'admin');
        // $user->givePermissions(['read', 'create', 'update', 'delete'], 'admin');
    }


    protected function activateOfficer($recievedParams)
    {
        $officerData = Officer::where([['officerCode', $recievedParams->activationCode], ['officer_user', null]])->first();
        if ($officerData) {
            try {
                $updateOfficer = Officer::where([['officerCode', $recievedParams->activationCode . ''], ['officer_user', null]])->update(['officer_user' => session()->get('user')->uid]);
                $rolesAndPermissionGiven = $updateOfficer ? $this->liasonRolesAndTeams($recievedParams->uid, $officerData->officer_type) : false;
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
    protected function liasonRolesAndTeams($uid, $type)
    {
        $team = Team::where('display_name', $type)->first();
        $role = Role::where('display_name', $type)->first();
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
                $updatedUser->images = ImageBlob::where('uid', $uid)->first();
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
            case "HL":
                $operatorActivated = $this->activateHotelOperator($req);
                // return $operatorActivated ?  "true" : "False";
                return $operatorActivated;
                break;
            case "LO":
                $officerActivated = $this->activateOfficer($req);
                return $officerActivated ? back()->with('message', 'Officer Updated Successfully') : back()->with('error', 'Officer already assigned');
                break;
            case "RO":
                $officerActivated = $this->activateOfficer($req);
                return $officerActivated ? back()->with('message', 'Officer Updated Successfully') : back()->with('error', 'Officer already assigned');
                break;
            case "IO":
                $officerActivated = $this->activateOfficer($req);
                return $officerActivated ? back()->with('message', 'Officer Updated Successfully') : back()->with('error', 'Officer already assigned');
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

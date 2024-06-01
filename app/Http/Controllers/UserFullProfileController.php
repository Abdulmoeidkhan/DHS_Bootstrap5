<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WishList;
use App\Models\Feedback;
use App\Models\Delegate;
use App\Models\ImageBlob;
use App\Models\Delegation;
use App\Models\InterestedProgram;
use Laratrust\Models\Role;
use Illuminate\Http\Request;
use Laratrust\Models\Permission;
use App\Http\Controllers\Controller;

class UserFullProfileController extends Controller
{
    public function render(Request $req, $id)
    {
        $roles = Role::all();
        $selectiveRoles = Role::where('name', 'user')->orWhere('name', 'admin')->orWhere('name', 'dho')->orWhere('name', 'vendor')->orWhere('name', 'army')->orWhere('name', 'navy')->orWhere('name', 'airforce')->get();
        $permissions = Permission::all();
        $user = User::with('roles', 'permissions')->where('uid', $id)->first();
        $image = ImageBlob::where('uid', $id)->first();
        $user->images = $image;
        return view('pages.profileUser', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions, 'selectiveRoles' => $selectiveRoles]);
    }
    public function renderMyProfile(Request $req)
    {
        $roles = Role::all();
        $selectiveRoles = Role::where('name', 'user')->orWhere('name', 'admin')->orWhere('name', 'dho')->orWhere('name', 'vendor')->orWhere('name', 'army')->orWhere('name', 'navy')->orWhere('name', 'airforce')->get();
        $permissions = Permission::all();
        $user = session()->get('user');
        // return $user;
        return view('pages.profileUser', ['user' => $user,  'roles' => $roles, 'permissions' => $permissions, 'selectiveRoles' => $selectiveRoles]);
    }
    public function renderDelegateProfile()
    {
        $delegate = Delegate::where([['delegation', session()->get('user')->delegationUid], ['delegation_type', 'Self']])->first();
        $rep = Delegate::where([['delegation', session()->get('user')->delegationUid], ['delegation_type', 'Rep']])->first();
        $delegationData = Delegation::where('uid', session()->get('user')->delegationUid)->first();
        // return session()->get('user')->delegationUid;
        $delegateImage = ImageBlob::where('uid', $delegate->delegates_uid)->first();
        $repImage = ImageBlob::where('uid', $rep->delegates_uid)->first();
        $delegateInterests = InterestedProgram::where('guest_uid', $delegate->delegates_uid)->get();
        $delegateWishes = WishList::where('guest_uid', $delegate->delegates_uid)->get();
        $delegateFeedback = Feedback::where('guest_uid', $delegate->delegates_uid)->get();
        $interests = [];
        foreach ($delegateInterests as $key => $delegateInterest) {
            array_push($interests, $delegateInterest->program_uid);
        }
        $delegate->interests = $interests;
        // return $repImage->img_blob;
        return view('pages.delegateProfile', ['delegate' => $delegate, 'delegateImage' => $delegateImage, 'repImage' => $repImage, 'rep' => $rep, 'delegationData' => $delegationData, 'delegateWishes' => $delegateWishes, 'delegateFeedback' => $delegateFeedback]);
    }
    public function renderSpeceficDelegateProfile(Request $req, $id)
    {
        $delegate = Delegate::where('user_uid', $id)->orWhere('delegates_uid', $id)->first();
        $delegateImage = ImageBlob::where('uid', $delegate->delegates_uid)->first();
        $repImage = ImageBlob::where('uid', $delegate->rep_uid)->first();
        $delegateInterests = InterestedProgram::where('guest_uid', $delegate->delegates_uid)->get(['program_uid']);
        $delegateWishes = WishList::where('guest_uid', $delegate->delegates_uid)->get();
        $delegateFeedback = Feedback::where('guest_uid', $delegate->delegates_uid)->get();
        $interests = [];
        foreach ($delegateInterests as $key => $delegateInterest) {
            array_push($interests, $delegateInterest->program_uid);
        }
        $delegate->interests = $interests;
        // return $delegate->interests;
        return view('pages.delegateProfile', ['delegate' => $delegate, 'delegateImage' => $delegateImage, 'repImage' => $repImage, 'delegateWishes' => $delegateWishes, 'delegateFeedback' => $delegateFeedback]);
    }
}

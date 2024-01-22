<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\ImageBlob;
use App\Models\InterestedProgram;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    public function renderDelegateProfile()
    {
        $delegate = Delegate::where([['delegation', session()->get('user')->delegationUid], ['delegation_type', 'Self']])->first();
        $rep = Delegate::where([['delegation', session()->get('user')->delegationUid], ['delegation_type', 'Representative']])->first();
        // return session()->get('user')->delegationUid;
        $delegateImage = ImageBlob::where('uid', $delegate->delegates_uid)->first();
        $repImage = ImageBlob::where('uid', $rep->delegates_uid)->first();
        $delegateInterests = InterestedProgram::where('guest_uid', $delegate->delegates_uid)->get();
        $interests = [];
        foreach ($delegateInterests as $key => $delegateInterest) {
            array_push($interests, $delegateInterest->program_uid);
        }
        $delegate->interests = $interests;
        // return $repImage->img_blob;
        return view('pages.delegateProfile', ['delegate' => $delegate, 'delegateImage' => $delegateImage, 'repImage' => $repImage, 'rep' => $rep]);
    }
    public function renderSpeceficDelegateProfile(Request $req, $id)
    {
        $delegate = Delegate::where('user_uid', $id)->orWhere('delegates_uid', $id)->first();
        $delegateImage = Image::where('uid', $delegate->delegates_uid)->first();
        $repImage = Image::where('uid', $delegate->rep_uid)->first();
        $delegateInterests = InterestedProgram::where('guest_uid', $delegate->delegates_uid)->get(['program_uid']);
        $interests = [];
        foreach ($delegateInterests as $key => $delegateInterest) {
            array_push($interests, $delegateInterest->program_uid);
        }
        $delegate->interests = $interests;
        // return $delegate->interests;
        return view('pages.delegateProfile', ['delegate' => $delegate, 'delegateImage' => $delegateImage, 'repImage' => $repImage]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;

class UserFullProfileController extends Controller
{
    public function render(Request $req,$id)
    {
        // $id;
        // return $id;
        $user = User::where('uid', $id)->first();
        $image = Image::where('uid', $id)->first();
        $user->images = $image;
        // return $image;
        // return $user;
        return view('pages.userProfile',['user'=>$user]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    public function deleteId(Request $req){
        $user = User::where('uid',$req->id)->update(['status' => 0]);
        $updated=$user?'User Deleted':'User Not found';
        return redirect()->route('userPanel')->with('error',$updated);
    }

    public function restoreId(Request $req){
        $user = User::where('uid',$req->id)->update(['status' => 1]);
        $updated=$user?'User Restore':'User Not found';
        return redirect()->route('userPanel')->with('error',$updated);
    }
}

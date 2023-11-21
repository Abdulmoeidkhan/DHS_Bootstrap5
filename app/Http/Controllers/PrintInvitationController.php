<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Delegation;
use Illuminate\Http\Request;

class PrintInvitationController extends Controller
{
    public function printInvitation($id)
    {
        $delegate = Delegate::where('delegation', $id)->orWhere('delegates_uid',$id)->first();
        $delegation = Delegation::where('uid', $delegate->delegation)->first();
        return view('pages.printPages.invitationPage', ['delegate' => $delegate,'delegation'=>$delegation]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\DelegateFlight;
use App\Models\Delegation;
use App\Models\ImageBlob;
use App\Models\Rank;
use App\Models\Vips;
use Illuminate\Http\Request;

class PrintInvitationController extends Controller
{
    public function printInvitation($id)
    {
        $delegate = Delegate::where('delegation', $id)->orWhere('delegates_uid', $id)->first();
        $delegation = Delegation::where('uid', $delegate->delegation)->first();
        $delegate->rankName = Rank::where('ranks_uid', $delegate->rank)->first();
        $delegate->invitedByDesignation = Vips::where('vips_uid', $delegation->invited_by)->first('vips_designation');

        return view('pages.printPages.invitationPage', ['delegate' => $delegate, 'delegation' => $delegation]);
    }

    public function printDelegationBadge($id)
    {
        $delegate = Delegate::where('delegation', $id)->orWhere('delegates_uid', $id)->first();
        $delegation = Delegation::where('uid', $delegate->delegation)->first();
        $delegate->rank = Rank::where('ranks_uid', $delegate->rank)->first('ranks_name');
        $delegate->image = ImageBlob::where('uid', $delegate->delegates_uid)->first();
        $delegate->flight = DelegateFlight::where('delegation_uid', $id)->orWhere('delegate_uid', $id)->first();
        // return $delegate;
        return view('pages.printPages.printBadge', ['delegate' => $delegate, 'delegation' => $delegation]);
    }

    public function printDelegationEnvelope($id)
    {
        $delegate = Delegate::where('delegation', $id)->orWhere('delegates_uid', $id)->first();
        $delegation = Delegation::where('uid', $delegate->delegation)->first();
        $delegate->rank = Rank::where('ranks_uid', $delegate->rank)->first('ranks_name');
        return view('pages.printPages.envelope', ['delegate' => $delegate, 'delegation' => $delegation]);
    }
}

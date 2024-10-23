<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\DelegateFlight;
use App\Models\Delegation;
use App\Models\ImageBlob;
use App\Models\Officer;
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

    public function printDelegationBadge($id, $type)
    {
        $printDoc = (object)[];
        switch ($type) {
            case "delegate":
                $delegate = Delegate::where('delegation', $id)->orWhere('delegates_uid', $id)->first();
                $printerFlag = Delegate::where('delegates_uid', $delegate->delegates_uid)->update(['isPrinted' => 1]);
                $delegation = Delegation::where('uid', $delegate->delegation)->first();
                $delegate->rank = Rank::where('ranks_uid', $delegate->rank)->first('ranks_name');
                $delegate->image = ImageBlob::where('uid', $delegate->delegates_uid)->first();
                $delegate->flight = DelegateFlight::where('delegation_uid', $id)->orWhere('delegate_uid', $id)->first();
                // return $delegation;
                $printDoc->first = $delegate->rank->ranks_name ?? '';
                $printDoc->second = $delegate->first_Name ?? '';
                $printDoc->third = $delegate->last_Name ?? '';
                $printDoc->forth = $delegate->flight->passport ?? '';
                $printDoc->fifth = $delegation->country ?? '';
                $printDoc->sixth = $delegate->delegateCode ?? '';
                $printDoc->image = $delegate->image ?? false;
                break;
            case "officer":
                $officer = Officer::where('officer_uid', $id)->first();
                $printerFlag = Officer::where('officer_uid', $id)->update(['isPrinted' => 1]);
                $officer->rank = Rank::where('ranks_uid', $officer->officer_rank)->first('ranks_name');
                $officer->image = ImageBlob::where('uid', $officer->officer_uid)->first();
                // return $delegation;
                $printDoc->first = $officer->rank->ranks_name ?? '';
                $printDoc->second = $officer->officer_first_name ?? '';
                $printDoc->third = $officer->officer_last_name ?? '';
                $printDoc->forth = $officer->officer_remarks ?? '';
                $printDoc->fifth = $officer->officer_identity ?? '';
                $printDoc->sixth = $officer->officerCode ?? '';
                $printDoc->image = $officer->image ?? false;
                break;
            default:
                return redirect()->back()->with('error', 'Something Went Wrong');
        }
        // return $printDoc;
        return view('pages.printPages.printBadge', ['printDoc' => $printDoc]);
    }

    public function printDelegationEnvelope($id)
    {
        $delegate = Delegate::where('delegation', $id)->orWhere('delegates_uid', $id)->first();
        $delegation = Delegation::where('uid', $delegate->delegation)->first();
        $delegate->rank = Rank::where('ranks_uid', $delegate->rank)->first('ranks_name');
        return view('pages.printPages.envelope', ['delegate' => $delegate, 'delegation' => $delegation]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DelegatesPageController extends Controller
{
    public function render()
    {
        return view('pages.delegates');
    }

    public function delegatesData($status = null)
    {
        if ($status == 1) {
            $delegates = DB::table('delegates')
                ->leftJoin('delegate_flights', 'delegate_flights.delegate_uid', '=', 'delegates.delegates_uid')
                ->leftJoin('image_blobs', 'delegates.delegates_uid', '=', 'image_blobs.uid')
                ->leftJoin('delegations', 'delegates.delegation', '=', 'delegations.uid')
                ->leftJoin('vips', 'vips.vips_uid', '=', 'delegations.invited_by')
                ->where([['delegates.first_Name', '!=', null], ['delegates.status', '1'], ['self', '1']])
                ->select('delegates.*', 'delegate_flights.*', 'image_blobs.uid','image_blobs.img_blob', 'delegations.country', 'delegations.delegationCode', 'delegations.delegation_status', 'delegations.invited_by', 'vips.*')
                ->orderBy('delegations.country', 'asc')
                ->get();

            foreach ($delegates as $key => $delegate) {
                $delegates[$key]->rankName = Rank::where('ranks_uid', $delegate->rank)->first('ranks_name');
                $delegates[$key]->invited_by_name = Rank::where('ranks_uid', $delegate->invited_by)->first('ranks_name');
                $delegates[$key]->isHead = $delegate->delegation_type !== "Member" ? "Yes" : "No";
            }
            return $delegates;
        } else if ($status == 0) {
            $delegates = DB::table('delegates')
                ->leftJoin('delegate_flights', 'delegate_flights.delegate_uid', '=', 'delegates.delegates_uid')
                ->leftJoin('image_blobs', 'delegates.delegates_uid', '=', 'image_blobs.uid')
                ->leftJoin('delegations', 'delegates.delegation', '=', 'delegations.uid')
                ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.vips_uid')
                ->where([['delegates.first_Name', '!=', null], ['delegates.status', '0'], ['self', '1']])
                ->select('delegates.*', 'delegate_flights.*', 'image_blobs.uid', 'delegations.country', 'delegations.invited_by', 'vips.*')
                ->orderBy('delegations.country', 'asc')
                ->get();

            foreach ($delegates as $key => $delegate) {
                $delegates[$key]->rankName = Rank::where('ranks_uid', $delegate[$key]->rank)->first('ranks_name');
                $delegates[$key]->invited_by->name = Rank::where('ranks_uid', $delegate[$key]->invited_by->name)->first('ranks_name');
            }
            return $delegates;
        }
    }

    public function getDelegatesStats()
    {
        $accepted = Delegation::where('delegation_response', 'Accepted')->count();
        $awaited = Delegation::where('delegation_response', 'Awaited')->count();
        $regretted = Delegation::where('delegation_response', 'Regretted')->count();
        return ['names' => ['Accepted', 'Awaited', 'Regretted'], 'values' => [$accepted, $awaited, $regretted]];
    }

    public function invitationUpdate(Request $req)
    {
        $updatedDelegate = Delegate::where('delegates_uid', $req->delegationUid)->update(['invitation_number' => $req->invitaionNumber]);
        return $updatedDelegate ? back()->with('message', 'Invitation Number Updated Successfully') : back()->with('error', 'Something Went Wrong');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\DelegateFlight;
use App\Models\Delegation;
use App\Models\Flightsegment;
use App\Models\Rank;
use App\Models\Vips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Delegation Attendance Start
    public function delegationAttendanceData(Request $req)
    {
        $delegations = Delegation::distinct('country')->get('country');

        foreach ($delegations as  $key => $delegation) {
            $delegations[$key]->count = Delegation::where('country', $delegation->country)->count();
            foreach (Delegation::where('country', $delegation->country)->get(['uid']) as $index => $delegataionUid) {
                $delegations[$key]->arrivedCount = $delegations[$key]->arrivedCount + DelegateFlight::where([['delegation_uid', $delegataionUid->uid], ['arrived', 1]])->count() ? 1 : 0;
            }
        }
        return $delegations;
    }
    // Delegation Attendance End

    //  Country Report Start

    public function countryReport()
    {
        return view('pages.reports.countryReport');
    }

    public function countryData()
    {
        $countries = Delegation::distinct('country')->get('country');
        foreach ($countries as $countrieskey => $country) {
            $countries[$countrieskey]->count = Delegation::where('country', $country->country)->count();
            $countries[$countrieskey]->regretted = Delegation::where([['country', $country->country], ['delegation_response', 'Regretted']])->count();
            $countries[$countrieskey]->accepted = Delegation::where([['country', $country->country], ['delegation_response', 'Accepted']])->count();
            $countries[$countrieskey]->awaited = Delegation::where([['country', $country->country], ['delegation_response', 'Awaited']])->count();
        }
        return $countries;
    }

    // Country Report End

    // Vip Start

    public function vipDelegationReport()
    {
        return view('pages.reports.delegationByVip');
    }

    public function vipDelegationData()
    {
        $invitees = Delegation::distinct('invited_by')->get('invited_by');
        foreach ($invitees as $inviteeskey => $invitee) {
            $invitees[$inviteeskey]->name = Vips::where('vips_uid', $invitee->invited_by)->first('vips_designation');
            $invitees[$inviteeskey]->count = Delegation::where('invited_by', $invitee->invited_by)->count();
            $invitees[$inviteeskey]->regretted = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Regretted']])->count();
            $invitees[$inviteeskey]->accepted = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Accepted']])->count();
            $invitees[$inviteeskey]->awaited = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Awaited']])->count();
        }
        return $invitees;
    }

    // Vip End

    // Country And Vip Start

    public function countryAndVipReport()
    {
        $vips = Vips::get();
        foreach ($vips as $key => $vip) {
            $vips[$key]->rankDetails = Rank::where('ranks_uid', $vip->vips_rank)->first();
        }
        return view('pages.reports.countryAndVipReport', ['vips' => $vips]);
    }

    public function countryAndVipData()
    {

        $countries = Delegation::distinct('country')->get('country');
        // $vips = Vips::get();
        foreach ($countries as $countrieskey => $country) {
            $delegations = Delegation::where('country', $country->country)->get();
            $countArray = [];
            foreach ($delegations as $delegationsKey => $delegation) {
                $vip = Vips::where('vips_uid', $delegation->invited_by)->first('vips_rank');
                $rank = Rank::where('ranks_uid', $vip->vips_rank)->first('ranks_name');
                $renameArray = [$rank->ranks_name => 1];
                array_push($countArray, [...$renameArray]);
            }
            $countries[$countrieskey]->totalCount = count($delegations);
            $countries[$countrieskey]->countArray = $countArray;
            // foreach ($vips as $vipsKey => $vip) {
            //     $vips[$vipsKey]->rankName = Rank::where('ranks_uid', $vip->vips_rank)->first('ranks_name');
            //     array_push($vipArray, $vips[$vipsKey]);
            //     $countries[$countrieskey]->vip = $vipArray;
            //     $countries[$countrieskey]->count = Delegation::where([['invited_by', $vip->vips_uid], ['country', $country->country]])->count();
            // }
        }
        return $countries;
    }

    // Country And Vip End

    // Self/Rep Start
    public function selfRepReport()
    {
        return view('pages.reports.selfRepReport');
    }

    public function selfRepData()
    {
        $invitees = Delegation::distinct('invited_by')->get();
        foreach ($invitees as $inviteeskey => $invitee) {
            $invitees[$inviteeskey]->name = Vips::where('vips_uid', $invitee->invited_by)->first('vips_designation');
            $invitees[$inviteeskey]->count = Delegation::where('invited_by', $invitee->invited_by)->count();
            $invitees[$inviteeskey]->awaited = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Awaited']])->count();
            $invitees[$inviteeskey]->regretted = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Regretted']])->count();
            $acceptedSelf = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Accepted']])->first();
            $invitees[$inviteeskey]->self = Delegate::where([['delegation', $acceptedSelf->uid], ['delegation_type', 'Self'], ['self', 1]])->count();
            $invitees[$inviteeskey]->rep = Delegate::where([['delegation', $acceptedSelf->uid], ['delegation_type', 'Rep'], ['self', 1]])->count();
        }
        return $invitees;
    }

    // Self/Rep End

    // Delegation Arrival Status Start

    public function delegationArrivalStatusReport()
    {
        $flights = DelegateFlight::distinct('arrival_date')->get('arrival_date');
        return view('pages.reports.delegationArrivalStatus', ['flights' => $flights]);
    }
    public function delegationArrivalStatusData()
    {
        $flights = DelegateFlight::distinct('delegation_uid')->get('delegation_uid');
        $delegations=[];
        foreach ($flights as $key => $flight) {
            array_push($delegations,Delegation::where('uid',$flight->delegation_uid)->first());
            $delegations[0]->flight=DelegateFlight::where('delegation_uid',$flight->delegation_uid)->get();
        }
        // $countries = array_map(function ($flight) {
        //     return Delegation::where('uid', $flight->delegation_uid)->get();
        // }, $flights);
        // return $countries;
        return $delegations;
    }

    // Delegation Arrival Status End

    public function listOfAllDelegation()
    {
        return view('pages.reports.listOfAllDelegation');
    }

    public function listOfAllDelegates()
    {
        return view('pages.reports.listOfAllDelegates');
    }

    public function delegationAttendance()
    {
        return view('pages.reports.delegationAttendance');
    }
}

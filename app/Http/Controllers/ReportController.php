<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DelegateFlight;
use App\Models\Delegation;
use App\Models\Vips;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
            $countries[$countrieskey]->awaited = Delegation::where([['country', $country->country], ['delegation_response', 'Awaited
            ']])->count();
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
            $invitees[$inviteeskey]->name = Vips::where('vips_uid',$invitee->invited_by)->first('vips_designation');
            $invitees[$inviteeskey]->count = Delegation::where('invited_by', $invitee->invited_by)->count();
            $invitees[$inviteeskey]->regretted = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Regretted']])->count();
            $invitees[$inviteeskey]->accepted = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Accepted']])->count();
            $invitees[$inviteeskey]->awaited = Delegation::where([['invited_by', $invitee->invited_by], ['delegation_response', 'Awaited
            ']])->count();
        }
        return $invitees;
    }

    // Vip End

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

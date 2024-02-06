<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    // Delegation Attendance Start
    public function delegationAttendanceData(Request $req)
    {
        // $delegation = DB::table('delegates')
        //     ->leftJoin('delegations', 'delegations.uid', '=', 'delegates.delegation')
        //     ->leftJoin('delegate_flights', 'delegate_flights.delegate_uid', '=', 'delegates.delegates_uid')
        //     ->where('delegations.delegation_response', 'Accepted')
        //     ->orderBy('delegations.country', 'asc')
        //     ->select('delegate_flights.arrived', 'delegations.country')
        //     ->get();
        $delegations = Delegation::distinct('country')->get('country');
        foreach ($delegations as  $key => $delegation) {
            $delegations[$key]->count = Delegation::where('country', $delegation->country)->count();
            
        }
        return $delegations;
    }
    // Delegation Attendance End

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

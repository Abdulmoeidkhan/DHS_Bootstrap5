<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DelegateFlight;
use App\Models\Delegation;
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

    public function countryReport(){
        return view('pages.reports.countryReport');
    }

    // Country Report End

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

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Officer;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function memberCountAccepted()
    {
        $memberCount = 0;
        $delegations = DB::table('delegations')
            ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'delegations.delegationhead')
            ->where([['delegations.delegation_response', 'Accepted'], ['delegations.delegation_status', '1']])
            ->select('delegations.*', 'delegates.self', 'delegates.delegates_uid')
            ->orderBy('delegations.country', 'asc')
            ->take(1000)
            ->get();

        foreach ($delegations as $key => $delegation) {
            $delegations[$key]->member_count = Delegate::where([['delegation', $delegation->uid], ['self', 1], ['status', 1]])->count();
        }

        if ($delegations->count() > 0) {
            $memberCount = $delegations->sum('member_count');
        }
        return $memberCount;
    }

    public function allDelegation()
    {
        return Delegation::where('delegation_status', 1)->count();
    }

    public function officersArmy()
    {
        $totalArmyOfficers['totalcount'] = Officer::where([['officer_remarks', 'army'], ['officer_status', '1']])->count();
        $totalArmyOfficers[0] = Officer::where([['officer_remarks', 'army'], ['officer_type', 'Liason'], ['officer_status', '1']])->count();
        $totalArmyOfficers[1] = Officer::where([['officer_remarks', 'army'], ['officer_type', 'Interpreter'], ['officer_status', '1']])->count();
        $totalArmyOfficers[2] = Officer::where([['officer_remarks', 'army'], ['officer_type', 'Receiving'], ['officer_status', '1']])->count();
        $totalArmyOfficers['assign'][0] = Officer::where([['officer_remarks', 'army'], ['officer_type', 'Liason'], ['officer_status', '1'],['officer_assign','1']])->count();
        $totalArmyOfficers['assign'][1] = Officer::where([['officer_remarks', 'army'], ['officer_type', 'Interpreter'], ['officer_status', '1'],['officer_assign','1']])->count();
        $totalArmyOfficers['assign'][2] = Officer::where([['officer_remarks', 'army'], ['officer_type', 'Receiving'], ['officer_status', '1'],['officer_assign','1']])->count();
        $totalArmyOfficers['unassign'][0] = Officer::where([['officer_remarks', 'army'], ['officer_type', 'Liason'], ['officer_status', '1'],['officer_assign','0']])->count();
        $totalArmyOfficers['unassign'][1] = Officer::where([['officer_remarks', 'army'], ['officer_type', 'Interpreter'], ['officer_status', '1'],['officer_assign','0']])->count();
        $totalArmyOfficers['unassign'][2] = Officer::where([['officer_remarks', 'army'], ['officer_type', 'Receiving'], ['officer_status', '1'],['officer_assign','0']])->count();
        return $totalArmyOfficers;
    }

    public function officersNavy()
    {
        $totalArmyOfficers['totalcount'] = Officer::where([['officer_remarks', 'navy'], ['officer_status', '1']])->count();
        $totalArmyOfficers[0] = Officer::where([['officer_remarks', 'navy'], ['officer_type', 'Liason'], ['officer_status', '1']])->count();
        $totalArmyOfficers[1] = Officer::where([['officer_remarks', 'navy'], ['officer_type', 'Interpreter'], ['officer_status', '1']])->count();
        $totalArmyOfficers[2] = Officer::where([['officer_remarks', 'navy'], ['officer_type', 'Receiving'], ['officer_status', '1']])->count();
        $totalArmyOfficers['assign'][0] = Officer::where([['officer_remarks', 'navy'], ['officer_type', 'Liason'], ['officer_status', '1'],['officer_assign','1']])->count();
        $totalArmyOfficers['assign'][1] = Officer::where([['officer_remarks', 'navy'], ['officer_type', 'Interpreter'], ['officer_status', '1'],['officer_assign','1']])->count();
        $totalArmyOfficers['assign'][2] = Officer::where([['officer_remarks', 'navy'], ['officer_type', 'Receiving'], ['officer_status', '1'],['officer_assign','1']])->count();
        $totalArmyOfficers['unassign'][0] = Officer::where([['officer_remarks', 'navy'], ['officer_type', 'Liason'], ['officer_status', '1'],['officer_assign','0']])->count();
        $totalArmyOfficers['unassign'][1] = Officer::where([['officer_remarks', 'navy'], ['officer_type', 'Interpreter'], ['officer_status', '1'],['officer_assign','0']])->count();
        $totalArmyOfficers['unassign'][2] = Officer::where([['officer_remarks', 'navy'], ['officer_type', 'Receiving'], ['officer_status', '1'],['officer_assign','0']])->count();
        return $totalArmyOfficers;
    }

    public function officersAirForce()
    {
        $totalArmyOfficers['totalcount'] = Officer::where([['officer_remarks', 'airforce'], ['officer_status', '1']])->count();
        $totalArmyOfficers[0] = Officer::where([['officer_remarks', 'airforce'], ['officer_type', 'Liason'], ['officer_status', '1']])->count();
        $totalArmyOfficers[1] = Officer::where([['officer_remarks', 'airforce'], ['officer_type', 'Interpreter'], ['officer_status', '1']])->count();
        $totalArmyOfficers[2] = Officer::where([['officer_remarks', 'airforce'], ['officer_type', 'Receiving'], ['officer_status', '1']])->count();
        $totalArmyOfficers['assign'][0] = Officer::where([['officer_remarks', 'airforce'], ['officer_type', 'Liason'], ['officer_status', '1'],['officer_assign','1']])->count();
        $totalArmyOfficers['assign'][1] = Officer::where([['officer_remarks', 'airforce'], ['officer_type', 'Interpreter'], ['officer_status', '1'],['officer_assign','1']])->count();
        $totalArmyOfficers['assign'][2] = Officer::where([['officer_remarks', 'airforce'], ['officer_type', 'Receiving'], ['officer_status', '1'],['officer_assign','1']])->count();
        $totalArmyOfficers['unassign'][0] = Officer::where([['officer_remarks', 'airforce'], ['officer_type', 'Liason'], ['officer_status', '1'],['officer_assign','0']])->count();
        $totalArmyOfficers['unassign'][1] = Officer::where([['officer_remarks', 'airforce'], ['officer_type', 'Interpreter'], ['officer_status', '1'],['officer_assign','0']])->count();
        $totalArmyOfficers['unassign'][2] = Officer::where([['officer_remarks', 'airforce'], ['officer_type', 'Receiving'], ['officer_status', '1'],['officer_assign','0']])->count();
        return $totalArmyOfficers;
    }


    public function renderSummary(){
        return view('pages.summary');
    }
}

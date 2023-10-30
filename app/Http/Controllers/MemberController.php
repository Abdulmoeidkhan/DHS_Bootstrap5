<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function render()
    {
        return view('pages.members');
    }
    public function membersData()
    {
        $members = DB::table('members')
            ->leftJoin('delegations', 'delegations.uid', '=', 'members.delegation')
            ->select('members.*', 'delegations.delegates', 'delegations.delegation_response', 'delegations.country')
            ->get();
        return $members;
    }
}

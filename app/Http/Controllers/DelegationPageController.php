<?php

namespace App\Http\Controllers;

use App\Models\Delegation;


use Illuminate\Http\Request;

class DelegationPageController extends Controller
{
    public function delegationData()
    {
        $delegation = Delegation::all();
        return $delegation;
    }
    public function render()
    {
        return view('pages.delegation');
    }
}

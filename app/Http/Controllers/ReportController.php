<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function listOfAllDelegation(){
        return view('pages.reports.listOfAllDelegation');
    }

    public function listOfAllDelegates(){
        return view('pages.reports.listOfAllDelegates');
    }
}

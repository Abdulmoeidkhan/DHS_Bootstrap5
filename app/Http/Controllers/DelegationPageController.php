<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DelegationPageController extends Controller
{
    public function render(){
        return view('pages.delegation');
    }
}

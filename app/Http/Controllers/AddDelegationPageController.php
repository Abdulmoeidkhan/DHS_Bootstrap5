<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddDelegationPageController extends Controller
{
    public function render(){
        return view('pages.addDelegation');
    }
    public function addDelegation(){
        return "Working";
    }
}

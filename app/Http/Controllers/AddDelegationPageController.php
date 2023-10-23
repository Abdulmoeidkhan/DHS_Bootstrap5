<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class AddDelegationPageController extends Controller
{
    public function render()
    {
        $events = Event::where('end_date', '>', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        return view('pages.addDelegation', ['events' => $events]);
    }
    public function addDelegation()
    {
        return "Working";
    }
}

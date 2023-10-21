<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laratrust\Laratrust;



class EventController extends Controller
{
    public function render(Request $req){
        return view('pages.events');
    }
}

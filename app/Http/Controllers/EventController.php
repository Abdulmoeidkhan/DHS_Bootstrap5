<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laratrust\Laratrust;



class EventController extends Controller
{
    public function render(Request $req)
    {
        // return date('Y-m-d') ;
        // return strtotime(date('Y-m-d')) < strtotime('2023-02-05');
        // return [...$futureEvent, ...$pastEvent];
        $pastEvents = Event::where('end_date', '<', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        $futureEvents = Event::where('end_date', '>', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        $allEvents = [...$futureEvents, ...$pastEvents];
        // return Storage::url('public/myeven/myeven.jpg');
        return view('pages.events',['pastEvents'=>$pastEvents,'futureEvents'=>$futureEvents,'allEvents'=>$allEvents]);
    }
}

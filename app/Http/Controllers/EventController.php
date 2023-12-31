<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;




class EventController extends Controller
{
    public function render(Request $req)
    {
        $pastEvents = Event::where('end_date', '<', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        $futureEvents = Event::where('end_date', '>', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        foreach($futureEvents as $key=>$futureEvent){
            $futureEvents[$key]->interested=session()->get('user')->interested != null ? in_array($futureEvent->uid,session()->get('user')->interested ):false;            
        }
        $allEvents = [...$futureEvents, ...$pastEvents];
        // return Storage::url('public/myeven/myeven.jpg');
        // return $futureEvents;
        return view('pages.events',['pastEvents'=>$pastEvents,'futureEvents'=>$futureEvents,'allEvents'=>$allEvents]);
    }
}

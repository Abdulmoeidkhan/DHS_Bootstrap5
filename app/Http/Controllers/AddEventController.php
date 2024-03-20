<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AddEventController extends Controller
{
    public function render()
    {
        $user = session()->get('user');
        return view('pages.addEvent', ['user' => $user]);
    }
    public function addEvent(Request $req)
    {
        $file = $req->file('eventBanner');
        $type = $file->extension();
        $event = new Event();
        $event->name = $req->eventName;
        $event->uid = (string) Str::uuid();
        $event->user_uid = $req->uid;
        $event->start_date = $req->startDate;
        $event->end_date = $req->endDate;
        $event->days = $req->days;
        $event->venue = $req->eventVenue;
        $event->description = $req->eventDescription;
        $event->banner = Storage::putFileAs('public/' . $req->eventName, $file, $req->eventName . '.' . $type);
        try {
            $savedEvent = $event->save();
            if ($savedEvent) {
                return redirect()->route('pages.addEvent')->with('message', "Event Successfully Added");
                // $file = $req->file('eventBanner');
                // Storage::putFileAs('public/uploads', $file->getClientOriginalName(), $file);
                // return redirect()->redirect()->back()->with('message', "Event Successfully Added");
                // $base64Image = base64_encode(file_get_contents($file->getRealPath()));
                // $base64 = 'data:image/' . $type . ';base64,' . $base64Image;
                // $image = new Image();
                // $image->base64_image = $base64;
                // $image->uid = $event->uid;
                // try {
                //     $image->save();
                //     return redirect()->redirect()->back()->with('message', "Event Successfully Added");
                // } catch (\Illuminate\Database\QueryException $exception) {
                //     return  redirect()->back()->with('error', $exception->errorInfo[2]);
                // }
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  redirect()->route('pages.addEvent')->with('error', 'Event already Exist error : ' . $exception->errorInfo[2]);
            } else {
                return  redirect()->route('pages.addEvent')->with('error', $exception->errorInfo[2]);
            }
        }
    }
}

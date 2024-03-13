<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EventInterestedController extends Controller
{
    public function updateInterest(Request $req, $id)
    {
        $event = Event::where('uid', $id)->first();
        $user = session()->get('user');
        if ($user->interested != null) {
            $oldEvent = $user->interested;
            $interestedEvent = json_encode([...$oldEvent, $event->uid]);
            try {
                $udpateInterest = User::where('uid', $user->uid)->update(['interested' =>  $interestedEvent]);
                $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
                $user->images = Image::where('uid', Auth::user()->uid)->first();
                session()->put('user', $user);
                return redirect()->back()->with('message', "Event Interest Update Successfully");
            } catch (\Illuminate\Database\QueryException $exception) {
                if ($exception->errorInfo[2]) {
                    // return  $exception->errorInfo[2];
                    return  redirect()->back()->with('error', 'Email Address already Exist error : ' . $exception->errorInfo[2]);
                } else {
                    return  redirect()->back()->with('error', $exception->errorInfo[2]);
                }
            }
            // return $udpateInterest;
            // return  $myArr;
            // return array_values($user->interested);
        } else {
            $interestedEvent = json_encode([$event->uid]);
            try {
                $udpateInterest = User::where('uid', $user->uid)->update(['interested' =>  $interestedEvent]);
                $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
                $user->images = Image::where('uid', Auth::user()->uid)->first();
                session()->put('user', $user);
                return redirect()->back()->with('message', "Event Interest Update Successfully");
            } catch (\Illuminate\Database\QueryException $exception) {
                if ($exception->errorInfo[2]) {
                    // return  $exception->errorInfo[2];
                    return  redirect()->back()->with('error', 'Email Address already Exist error : ' . $exception->errorInfo[2]);
                } else {
                    return  redirect()->route('404');
                    // return  redirect()->back()->with('error', $exception->errorInfo[2]);
                }
            }
        }
    }
}

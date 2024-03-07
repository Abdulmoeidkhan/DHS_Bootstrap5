<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    public function getFeedback($id)
    {
        $feedback = Feedback::where('guest_uid', $id)->orWhere('feedback_uid', $id)->orWhere('delegation_uid', $id)->get();
        return $feedback;
    }

    public function setFeedback(Request $req)
    {
        $feedback = new Feedback();
        $feedback->feedback_uid = (string) Str::uuid();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $feedback[$key] = $value;
            }
        }
        try {
            $savedFeedback = $feedback->save();
            if ($savedFeedback) {
                return back()->with('message', "Feedback Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
    public function deleteFeedback(Request $req)
    {
        try {
            $deleteFeedback = Feedback::where('guest_uid', $req->id)->orWhere('feedback_uid', $req->id)->orWhere('delegation_uid', $req->id)->delete();
            if ($deleteFeedback) {
                return back()->with('error', "Feedback Deleted Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
}

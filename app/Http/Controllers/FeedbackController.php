<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    public function getFeedback($id)
    {
        $feedback = Feedback::where('guest_uid', $id)->orWhere('feedback_uid', $id)->orWhere('delegation_uid', $id)->get();
        return $feedback;
    }

    public function getFeedbackWithDelegation($id = null)
    {
        $getFeedbackWithDelegation = $id ?
            DB::table('feedback')
            ->leftJoin('delegations', 'delegations.uid', '=', 'feedback.delegation_uid')
            ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'delegations.delegationhead')
            ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.vips_uid')
            ->where([['delegations.delegation_status', '1'], ['feedback_uid', $id]])
            ->orWhere([['delegations.delegation_status', '1'], ['delegation_uid', $id]])
            ->select('delegations.*', 'feedback.*', 'vips.*', 'delegates.first_Name', 'delegates.last_Name')
            ->get()
            : DB::table('feedback')
            ->leftJoin('delegations', 'delegations.uid', '=', 'feedback.delegation_uid')
            ->leftJoin('delegates', 'delegates.delegates_uid', '=', 'delegations.delegationhead')
            ->leftJoin('vips', 'delegations.invited_by', '=', 'vips.vips_uid')
            ->where([['delegations.delegation_status', '1']])
            ->select('delegations.*', 'feedback.*', 'vips.*', 'delegates.first_Name', 'delegates.last_Name')
            ->get();
        return $getFeedbackWithDelegation;
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
                return redirect()->route('pages.delegateProfile')->with('message', "Feedback Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->route('pages.delegateProfile')->with('error', $exception->errorInfo[2]);
        }
    }
    public function deleteFeedback(Request $req)
    {
        try {
            $deleteFeedback = Feedback::where('guest_uid', $req->id)->orWhere('feedback_uid', $req->id)->orWhere('delegation_uid', $req->id)->delete();
            if ($deleteFeedback) {
                return redirect()->route('pages.delegateProfile')->with('error', "Feedback Deleted Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  redirect()->route('pages.delegateProfile')->with('error', $exception->errorInfo[2]);
        }
    }

    public function feedbackPageRender(Request $req)
    {
        return view('pages.feedback');
    }
}

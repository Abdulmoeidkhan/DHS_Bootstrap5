<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InterestedProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InterestController extends Controller
{
    private function updatePrograms($req)
    {
        $savedPrograms = [];
        $deleteData = InterestedProgram::where('guest_uid', $req->guest_uid)->delete();
        foreach ($req->all() as $key => $value) {
            $interestProgram = new InterestedProgram();
            $interestProgram->interest_uid = (string) Str::uuid();
            $interestProgram->guest_uid = $req->guest_uid;
            $interestProgram->delegation_uid = $req->delegation_uid;
            if ($key != 'submit' && $key != 'guest_uid' && $key != 'delegation_uid' && $key != '_token' && strlen($value) > 0) {
                $interestProgram->program_uid = $value;
                try {
                    $savedProgram = $interestProgram->save();
                    array_push($savedPrograms, $savedProgram);
                } catch (\Illuminate\Database\QueryException $exception) {
                    return  redirect()->back()->with('error', $exception->errorInfo[2]);
                }
            }
        }
        return in_array(false, $savedPrograms) ? false : true;
    }
    public function getInterests(Request $req, $id = null)
    {
        return $req->all();
    }

    public function setInterests(Request $req, $id = null)
    {
        if ($this->updatePrograms($req)) {
            return redirect()->back()->with('message', "Plan Updated Successfully");
        } else {
            return redirect()->back()->with('error', "SomeThing Went Wrong");
        }
    }
}

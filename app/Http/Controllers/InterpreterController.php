<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Image;
use App\Models\Interpreter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class InterpreterController extends Controller
{

    protected function badge($characters, $prefix)
    {
        $possible = '0123456789';
        $code = $prefix;
        $i = 0;
        while ($i < $characters) {
            $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if ($i < $characters - 1) {
                $code .= "";
            }
            $i++;
        }
        return $code;
    }

    public function renderInterpreters()
    {
        return view('pages.interpreters');
    }

    public function renderSpecificInterpreter()
    {
        $delegationUid = Delegate::where('user_uid', session()->get('user')->uid)->first('delegation');
        $interpreter = Delegation::where('uid', $delegationUid->delegation)->first('interpreters');
        return view('pages.interpreterProfile', ['delegationUid' => $delegationUid, 'interpreter' => $interpreter]);
    }

    public function addInterpreterPage()
    {
        return view('pages.addInterpreters');
    }

    public function interpretersData()
    {
        $delegations = DB::table('interpreters')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'interpreters.interpreter_delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'interpreters.interpreter_delegation')
            ->select('interpreters.*', 'delegations.country', 'delegates.last_Name', 'delegates.first_Name')
            ->get();
        return $delegations;
    }

    public function specificInterpretersData($id = null)
    {
        $interpreter = $id ? DB::table('interpreters')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'interpreters.interpreter_delegation')
            ->leftJoin('delegations', 'delegations.uid', '=', 'interpreters.interpreter_delegation')
            ->where('interpreters.interpreter_uid', $id)
            ->orWhere('interpreters.interpreter_officer', $id)
            ->select('interpreters.*', 'delegations.country', 'delegates.last_Name', 'delegates.first_Name')
            ->first() : null;
        $interpreter->image = $id ? Image::where('uid', $interpreter->interpreter_officer)->first() : 'null';
        // return $interpreter;
        return view('pages.interpreterProfile', ['interpreter' => $interpreter]);
    }

    public function addInterpreter(Request $req)
    {
        $interpreter = new Interpreter();
        $interpreter->interpreter_uid  = (string) Str::uuid();
        $interpreter->interpreter_rank = $req->interpreter_rank;
        $interpreter->interpreter_designation = $req->interpreter_designation;
        $interpreter->interpreter_first_name = $req->interpreter_first_name;
        $interpreter->interpreter_last_name = $req->interpreter_last_name;
        $interpreter->interpreter_contact = $req->interpreter_contact;
        $interpreter->interpreter_identity = $req->interpreter_identity;
        $interpreter->interpreterCode  = $this->badge(8, "IO");
        try {
            $interpreterSaved = $interpreter->save();
            if ($interpreterSaved) {
                return back()->with('message', 'Interpreter has been added Successfully');
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }

    public function updateInterpreterRequest(Request $req, $id)
    {
        $arrayToBeUpdate = [];
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $arrayToBeUpdate[$key] = $value;
            }
        }
        try {
            $updatedInterpreter = Interpreter::where('interpreter_uid', $id)->update($arrayToBeUpdate);
            if ($updatedInterpreter) {
                return back()->with('message', 'Interpreter Updated Successfully');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function attachInterpreter(Request $req)
    {
        return $req->all();
        // try {
        //     $updateInterpreter = Interpreter::where('interpreter_uid', $req->interpreterSelect)->update(['interpreter_delegation' => $req->delegationUid, 'interpreter_assign' => 1]);
        //     if ($updateInterpreter) {
        //         $updateDelegation = Delegation::where('uid', $req->delegationUid)->update(['interpreters' => $req->interpreterSelect]);
        //         return back()->with('message', 'Interpreter has been attach Successfully');
        //     }
        // } catch (QueryException $exception) {
        //     if ($exception->errorInfo[2]) {
        //         return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
        //     } else {
        //         return  back()->with('error', $exception->errorInfo[2]);
        //     }
        // }
    }
}

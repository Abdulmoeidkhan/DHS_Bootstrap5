<?php

namespace App\Http\Controllers;

use App\Models\InterestedProgram;
use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function renderPrograms()
    {
        return view('pages.programs');
    }

    public function programsData()
    {
        $program = Program::get();
        return $program;
    }

    public function addProgramPages()
    {
        return view("pages.addProgram");
    }

    public function addProgram(Request $req)
    {
        $program = new Program();
        $program->program_uid = (string) Str::uuid();
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $program[$key] = $value;
            }
        }
        // $program->program_day = $req->program_day;
        // $program->program_time = $req->program_time;
        // $program->program_name = $req->program_name;

        try {
            $savedProgram = $program->save();
            if ($savedProgram) {
                return back()->with('message', "Program Added Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function deleteProgram(Request $req, $id)
    {

        try {
            $deleteProgram = Program::where('program_uid', $id)->delete();
            if ($deleteProgram) {
                $deletedInterests = InterestedProgram::where('program_uid', $id)->delete();
                return back()->with('message', "Program Deleted Successfully");
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
}

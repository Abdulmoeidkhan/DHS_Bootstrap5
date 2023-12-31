<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Member;
use App\Models\Delegation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Rank;

class MemberController extends Controller
{
    protected function imageUpload($file, $id)
    {
        $type = $file->extension();
        $base64Image = base64_encode(file_get_contents($file->getRealPath()));
        $base64 = 'data:image/' . $type . ';base64,' . $base64Image;
        $image = new Image();
        $image->base64_image = $base64;
        $image->uid = $id;
        $image->save();
    }
    protected function documentUpload($file, $id)
    {

        // $type = $file->extension();
        // $base64Pdf = base64_encode(file_get_contents($file->getRealPath()));
        // $pdfBlob = 'data:application/pdf;base64,' . $base64Pdf;
        $pdfBlob = file_get_contents($file->getRealPath());
        $pdf = new Document();
        $pdf->pdf_blob = $pdfBlob;
        $pdf->uid = $id;
        $pdf->save();
    }

    public function render($id)
    {
        return view('pages.members', ['id' => $id]);
    }


    public function addMemberPage(Request $req, $id)
    {
        return view('pages.addMember', ['id' => $id]);
    }

    public function membersData(Request $req, $id)
    {
        // return $id;
        $delegationUid = Delegation::where('delegates', $id)->orWhere('uid', $id)->first('uid');
        $members = DB::table('members')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'members.delegation')
            ->where('members.delegation', $delegationUid->uid)
            ->select('members.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.country')
            ->get();
        return $members;
    }
    public function specificMembersData(Request $req, $id)
    {
        $delegationUid = Delegation::where('delegates', $id)->first('uid');
        $members = DB::table('members')
            ->leftJoin('delegates', 'delegates.delegation', '=', 'members.delegation')
            ->where('members.delegation', $delegationUid->uid)
            ->select('members.*', 'delegates.first_Name', 'delegates.last_Name', 'delegates.country')
            ->get();
        return $members;
    }

    public function addMemberRequest(Request $req)
    {
        $delegationUid = Delegation::where('delegates', $req->delegation)->orWhere('uid', $req->delegation)->first('uid');
        $member = new Member();
        $member->member_uid = (string) Str::uuid();
        $member->delegation = $delegationUid->uid;
        $member->member_first_Name = $req->firstName;
        $member->member_last_Name = $req->lastName;
        $member->member_designation = $req->designation;
        $member->member_organistaion = $req->organistaion;
        $member->member_rank = $req->rank;
        $member->member_passport = $req->passport;
        try {
            $savedMember = $member->save();
            $this->imageUpload($req->file('picture'), $member->member_uid);
            $this->documentUpload($req->file('pdf'), $member->member_uid);
            if ($savedMember) {
                return redirect()->route("pages.addMember", $req->delegation)->with('message', 'Member Updated Successfully');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
    public function updateMemberRequest(Request $req, $id)
    {
        $arrayToBeUpdate = [];
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
                $arrayToBeUpdate[$key] = $value;
            }
        }
        try {
            // $updatedMember = Member::where('member_uid', $id)->update(['name' => $req->inputUserName, 'contact_number' => $req->inputContactNumber]);
            $updatedMember = Member::where('member_uid', $id)->update($arrayToBeUpdate);
            if ($updatedMember) {
                return back()->with('message', 'Member Updated Successfully');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    public function memberFullProfile(Request $req, $id)
    {
        $member = Member::where('member_uid', $id)->first();
        $member->image = Image::where('uid', $id)->first();
        // $member->document = Document::where('uid', $id)->first();
        // return $member;
        return view('pages.memberProfile', ['member' => $member]);
    }
}

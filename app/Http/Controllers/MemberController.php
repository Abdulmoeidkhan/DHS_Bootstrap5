<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Member;
use App\Models\Delegation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Delegate;
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
        $delegation = Delegation::where('uid', $id)->first();
        $delegates = Delegate::where('delegation', $delegation->uid)->get();
        foreach ($delegates as $key => $delegate) {
            $delegates[$key]->head = $delegate->delegates_uid == $delegation->delegationhead ? "Head" : "Member";
            $delegates[$key]->rankName = Rank::where('ranks_uid', $delegate->rank)->first('ranks_name');
        }
        return $delegates;
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
        $delegationUid = Delegation::where('uid', $req->delegation)->first('uid');
        $delegate = new Delegate();
        $delegate->delegates_uid = (string) Str::uuid();
        $delegate->rank = $req->rank;
        $delegate->delegation = $delegationUid->uid;
        $delegate->first_Name = $req->firstName;
        $delegate->last_Name = $req->lastName;
        $delegate->designation = $req->designation;
        $delegate->organistaion = $req->organistaion;
        $delegate->passport = $req->passport;
        $delegate->delegation_type = $req->delegation_type;
        try {
            $savedMember = $delegate->save();
            $req->file('picture') ? $this->imageUpload($req->file('picture'), $delegate->member_uid) : '';
            $req->file('pdf') ? $this->documentUpload($req->file('pdf'), $delegate->member_uid) : '';
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

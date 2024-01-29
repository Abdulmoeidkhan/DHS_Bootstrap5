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
use App\Models\DelegateFlight;
use App\Models\Document;
use App\Models\Flightsegment;
use App\Models\ImageBlob;
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
        $pdfBlob = file_get_contents($file->getRealPath());
        $pdf = new Document();
        $pdf->pdf_blob = $pdfBlob;
        $pdf->uid = $id;
        $pdf->save();
    }

    protected function imageBlobUpload($file, $id)
    {
        $imageBlob = $file;
        $imgBlob = new ImageBlob();
        $imgBlob->img_blob = $imageBlob;
        $imgBlob->uid = $id;
        $imgSaved = $imgBlob->save();
        return $imgSaved;
    }

    protected function documentUpdate($file, $id)
    {
        $pdfBlob = file_get_contents($file->getRealPath());
        $updatePdfBlob = Document::where('uid', $id)->first() ? Document::where('uid', $id)->update(['pdf_blob' => $pdfBlob]) : $this->documentUpload($file, $id);
        return $updatePdfBlob;
    }
    protected function imageBlobUpdate($file, $id)
    {
        $imageBlob = $file;
        $updateImageBlob = ImageBlob::where('uid', $id)->first() ? ImageBlob::where('uid', $id)->update(['img_blob' => $imageBlob]) : $this->imageBlobUpload($file, $id);
        return $updateImageBlob;
    }

    public function render($id)
    {
        return view('pages.members', ['id' => $id]);
    }


    public function addMemberPage(Request $req, $id)
    {
        $member = Delegate::where('delegates_uid', $id)->first();
        $flight = DelegateFlight::where('delegate_uid', $id)->first();
        $memberPicture = ImageBlob::where('uid', $id)->first();
        // return $member;
        return view('pages.addMember', ['member' => $member, 'flight' => $flight, 'id' => $id, 'memberPicture' => $memberPicture]);
    }

    public function membersData(Request $req, $id)
    {
        $delegation = Delegation::where('uid', $id)->first();
        $delegates = Delegate::where([['delegation', $delegation->uid],['first_Name','!=',null]])->get();
        foreach ($delegates as $key => $delegate) {
            $delegates[$key]->head = $delegate->delegates_uid == $delegation->delegationhead ? "Head" : "Member";
            $delegates[$key]->rankName = Rank::where('ranks_uid', $delegate->rank)->first('ranks_name');
            $delegates[$key]->flight = DelegateFlight::where('delegate_uid', $delegate->delegates_uid)->first();
            $delegates[$key]->image = ImageBlob::where('uid', $delegate->delegates_uid)->first();
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
        // return $req;
        // $delegationUid = Delegation::where('user_uid', $req->delegation)->first();
        $delegate = new Delegate();
        $delegate->delegates_uid = (string) Str::uuid();
        $delegate->rank = $req->rank;
        $delegate->delegation = $req->delegation;
        $delegate->first_Name = $req->firstName;
        $delegate->last_Name = $req->lastName;
        $delegate->designation = $req->designation;
        $delegate->delegation_type = $req->delegation_type;
        // $delegate->organistaion = $req->organistaion;
        // $delegate->passport = $req->passport;
        // return $req->all();
        try {
            $savedMember = $delegate->save();
            $imgSaved = $req->savedpicture ? $this->imageBlobUpload($req->savedpicture, $delegate->delegates_uid) : '';
            $req->file('pdf') ? $this->documentUpload($req->file('pdf'), $delegate->delegates_uid) : '';
            if ($savedMember) {
                return back()->with('message', 'Member Updated Successfully');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }
    public function updateMemberRequest(Request $req, $id)
    {
        $arrayToBeUpdate = [];
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && $key != 'savedpicture'  && $key != 'picture' && $key != 'pdf' && strlen($value) > 0) {
                $arrayToBeUpdate[$key] = $value;
            }
        }
        try {
            $updatedMember = Delegate::where('delegates_uid', $id)->update($arrayToBeUpdate);
            if ($req->savedpicture) {
                $imgSaved = $req->savedpicture ? $this->imageBlobUpdate($req->savedpicture, $id) : '';
            }
            if ($req->pdf) {

                $req->file('pdf') ? $this->documentUpdate($req->file('pdf'), $id) : '';
            }
            if ($updatedMember) {
                return back()->with('message', 'Member Updated Successfully');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            return  back()->with('error', $exception->errorInfo[2]);
        }
    }

    // public function memberFullProfile(Request $req, $id)
    // {
    //     $member = Member::where('member_uid', $id)->first();
    //     $member->image = Image::where('uid', $id)->first();
    //     // $member->document = Document::where('uid', $id)->first();
    //     // return $member;
    //     return view('pages.memberProfile', ['member' => $member]);
    // }
}

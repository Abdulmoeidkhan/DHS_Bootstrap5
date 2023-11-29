<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Delegation;
use App\Models\Document;
use App\Models\ImageBlob;
use Illuminate\Support\Str;

class AddDelegationPageController extends Controller
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

    protected function documentUpload($file, $id)
    {
        $pdfBlob = file_get_contents($file->getRealPath());
        $pdf = new Document();
        $pdf->pdf_blob = $pdfBlob;
        $pdf->uid = $id;
        $pdfSaved = $pdf->save();
        return $pdfSaved;
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

    public function render($id = null)
    {
        $events = Event::where('end_date', '>', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        if ($id) {
            $delegationHead = Delegate::where([['delegation_type', 'Delegate'], ['delegation', $id]])->first();
            $representatives = Delegate::where([['delegation_type', 'Representative'], ['delegation', $id]])->first();
            $delegations = Delegation::where([['uid', $delegationHead->delegation]])->first();
            $delegationHead->delegation_picture = ImageBlob::where('uid', $delegationHead->delegates_uid)->first();
            $delegationHead->delegation_document =  Document::where('uid', $delegationHead->delegates_uid)->count();
            if ($representatives) {
                $representatives->delegation_picture =  ImageBlob::where('uid', $representatives->delegates_uid)->first();
                $representatives->delegation_document =  Document::where('uid', $representatives->delegates_uid)->count();
            }
            return view('pages.addDelegation', ['events' => $events, 'delegationHead' => $delegationHead, 'representatives' => $representatives, 'delegations' => $delegations]);
            // return [$delegationHead, $representatives, $delegations];
        } else {
            return view('pages.addDelegation', ['events' => $events]);
        }
    }
    public function addDelegation(Request $req)
    {

        $delegates = new Delegate();
        $delegates->delegates_uid = (string) Str::uuid();
        $delegates->rank = $req->rank;
        $delegates->delegation_type = 'Delegate';
        $delegates->first_Name = $req->first_Name;
        $delegates->last_Name = $req->last_Name;
        $delegates->designation = $req->designation;

        $delegation = new Delegation();
        $delegation->uid = (string) Str::uuid();
        $delegation->country = $req->country;
        $delegation->invited_by = $req->invitedBy;
        $delegation->address = $req->address;
        $delegation->exhibition = $req->eventSelect;
        $delegation->delegationCode = $this->badge(8, "DL");


        $delegateSaved = 0;
        if ($req->self) {
            $delegates->self = 1;
            $delegation->delegationhead = $delegates->delegates_uid;
            $delegates->delegation = $delegation->uid;
            $imgSaved = $req->savedpicture ? $this->imageBlobUpload($req->savedpicture, $delegates->delegates_uid) : '';
            $pdfSaved = $req->file('pdf') ? $this->documentUpload($req->file('pdf'), $delegates->delegates_uid) : '';
            $delegateSaved = $delegates->save();
        } else {
            $representative = new Delegate();
            $representative->delegates_uid = (string) Str::uuid();
            $representative->rank = $req->rep_rank;
            $representative->delegation_type = 'Representative';
            $representative->first_Name = $req->rep_first_Name;
            $representative->last_Name = $req->rep_last_Name;
            $representative->designation = $req->rep_designation;
            $delegation->delegationhead = $representative->delegates_uid;
            $representative->delegation = $delegation->uid;
            $delegates->delegation = $delegation->uid;
            $delegates->self = 0;
            $representativeSaved = $representative->save();
            if ($representativeSaved) {
                $imgSaved = $req->savedRepresentativesPicture ? $this->imageBlobUpload($req->savedRepresentativesPicture, $representative->delegates_uid) : '';
                $pdfSaved = $req->file('repPdf') ? $this->documentUpload($req->file('repPdf'), $representative->delegates_uid) : '';
                $delegateSaved = $delegates->save();
            }
        }
        try {

            if ($delegateSaved) {
                $delegationSaved = $delegation->save();
                if ($delegationSaved) {
                    return back()->with('message', 'Delegation has been added Successfully');
                }
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            // return $exception->errorInfo[2];
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }

    public function updateDelegationRequest(Request $req)
    {
        $arrayToBeUpdate = [];
        return "Working";
        // return $req->all();
        // foreach ($req->all() as $key => $value) {
        //     if ($key != 'submit' && $key != '_token' && $key != 'savedpicture'  && $key != 'picture' && $key != 'delegation_picture' && $key != 'pdf' && $key != 'savedRepresentativesPicture' && $key != 'repPdf' && strlen($value) > 0) {
        //         $arrayToBeUpdate[$key] = $value;
        //     }
        // }
        // try {

        //     $officerUpdate = Delegate::where('officer_uid', $id)->update($arrayToBeUpdate);
        //     // $pdfUpdate = $req->pdf ? $this->documentUpdate($req->file('pdf'), $id) : 0;
        //     $imgUpdate = $req->savedpicture ? $this->imageBlobUpdate($req->savedpicture, $id) : 0;
        //     if ($officerUpdate) {
        //         return back()->with('message', 'Officer has been updated Successfully');
        //     }
        // } catch (\Illuminate\Database\QueryException $exception) {
        //     if ($exception->errorInfo[2]) {
        //         return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
        //     } else {
        //         return  back()->with('error', $exception->errorInfo[2]);
        //     }
        // }
    }

    // public function updateDelegation(Request $req)
    // {
    //     $arrayToBeUpdate = [];
    //     foreach ($req->all() as $key => $value) {
    //         if ($key != 'submit' && $key != '_token' && strlen($value) > 0) {
    //             $arrayToBeUpdate[$key] = $value;
    //         }
    //     }
    //     try {
    //         $updatedDelegate = Delegate::where('user_uid', $req->uid)->orWhere('delegates_uid', $req->uid)->update($arrayToBeUpdate);
    //         if ($updatedDelegate) {
    //             return back()->with('message', 'Delegation has been updated Successfully');
    //         }
    //     } catch (\Illuminate\Database\QueryException $exception) {
    //         if ($exception->errorInfo[2]) {
    //             return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
    //         } else {
    //             return  back()->with('error', $exception->errorInfo[2]);
    //         }
    //     }
    // }
}

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

    public function render($id = null)
    {
        $events = Event::where('end_date', '>', date('Y-m-d'))->orderBy('start_date', 'desc')->get();
        if ($id) {
            $delegationHead = Delegate::where([['delegation_type', 'Self'], ['delegation', $id]])->first();
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
        $delegates->rank = $req->self_rank;
        $delegates->delegation_type = 'Self';
        $delegates->first_Name = $req->self_first_Name;
        $delegates->last_Name = $req->self_last_Name;
        $delegates->designation = $req->self_designation;

        $delegation = new Delegation();
        $delegation->uid = (string) Str::uuid();
        $delegation->country = $req->country;
        $delegation->invited_by = $req->invited_by;
        $delegation->address = $req->address;
        $delegation->delegation_response = $req->delegation_response;
        $delegation->exhibition = $req->exhibition;
        $delegation->delegationCode = $this->badge(8, "DL");

        $representative = new Delegate();
        $representative->delegates_uid = (string) Str::uuid();
        $representative->delegation_type = 'Representative';
        $representative->delegation = $delegation->uid;


        $delegateSaved = 0;
        if ($req->self) {
            $delegates->self = 1;
            $delegation->delegationhead = $delegates->delegates_uid;
            $delegates->delegation = $delegation->uid;
            $imgSaved = $req->savedpicture ? $this->imageBlobUpload($req->savedpicture, $delegates->delegates_uid) : '';
            $pdfSaved = $req->file('pdf') ? $this->documentUpload($req->file('pdf'), $delegates->delegates_uid) : '';
            $representative->self = 0;
        } else {
            $representative->rank = $req->rep_rank;
            $representative->first_Name = $req->rep_first_Name;
            $representative->last_Name = $req->rep_last_Name;
            $representative->designation = $req->rep_designation;
            $delegation->delegationhead = $delegates->delegates_uid;
            $delegates->delegation = $delegation->uid;
            $delegates->self = 0;
        }
        $representativeSaved = $representative->save();
        $delegateSaved = $delegates->save();
        if ($representativeSaved) {
            $imgSaved = $req->savedRepresentativesPicture ? $this->imageBlobUpload($req->savedRepresentativesPicture, $representative->delegates_uid) : '';
            $pdfSaved = $req->file('rep_Pdf') ? $this->documentUpload($req->file('rep_Pdf'), $representative->delegates_uid) : '';
        }
        try {
            if ($delegateSaved) {
                $delegationSaved = $delegation->save();
                if ($delegationSaved) {
                    return $req->submitAndRetain ? back()->with('message', 'Delegation has been added Successfully') : redirect()->route('pages.delegationsPage')->with('message', 'Profile has been activated');
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

    public function updateDelegationRequest(Request $req, $retain = null)
    {
        $arrayToBeUpdate = [];
        $arrayToBeUpdateRep = [];
        $arrayToBeUpdateSelf = [];
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && $key != 'savedpicture' && $key != 'submitAndRetain'  && $key != 'delegation_picture' && $key != 'pdf' && $key != 'rep_Pdf' && $key != 'rep_saved_picture' && $key != 'rep_picture' && strlen($value) > 0) {
                if (substr($key, 0, 4) == 'rep_') {
                    $arrayToBeUpdateRep[substr($key, 4)] = $value;
                } elseif (substr($key, 0, 5) == 'self_') {
                    $arrayToBeUpdateSelf[substr($key, 5)] = $value;
                } else {
                    if ($key == 'self') {
                        $arrayToBeUpdate['delegationhead'] = $req->self_delegation_uid;
                        $arrayToBeUpdateRep['self'] = $value ? 0 : 1;
                        $arrayToBeUpdateSelf['self'] = $value;
                    }
                    if ($key !== 'self') {
                        $arrayToBeUpdate[$key] = $value;
                    }
                }
            }
        }
        // return [$arrayToBeUpdate, $arrayToBeUpdateRep, $arrayToBeUpdateSelf];
        $delegationRepUid = $arrayToBeUpdateRep['delegation_uid'];
        $delegationSelfUid = $arrayToBeUpdateSelf['delegation_uid'];
        unset($arrayToBeUpdateRep['delegation_uid']);
        unset($arrayToBeUpdateSelf['delegation_uid']);
        try {
            $delegationUpdate = Delegation::where('uid', $arrayToBeUpdate['uid'])->update($arrayToBeUpdate);
            $representativeUpdate = Delegate::where('delegates_uid', $delegationRepUid)->update($arrayToBeUpdateRep);
            $delegateUpdate = Delegate::where('delegates_uid', $delegationSelfUid)->update($arrayToBeUpdateSelf);
            $req->rep_Pdf ? $this->documentUpdate($req->file('rep_Pdf'), $delegationRepUid) : 0;
            $req->rep_saved_picture ? $this->imageBlobUpdate($req->rep_saved_picture, $delegationRepUid) : 0;
            $req->pdf ? $this->documentUpdate($req->file('pdf'), $delegationSelfUid) : 0;
            $req->savedpicture ? $this->imageBlobUpdate($req->savedpicture, $delegationSelfUid) : 0;
            if ($delegateUpdate) {
                return $req->submitAndRetain ? back()->with('message', 'Delegation has been updated Successfully') : redirect()->route('pages.delegationsPage')->with('message', 'Profile has been activated');
            }
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
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

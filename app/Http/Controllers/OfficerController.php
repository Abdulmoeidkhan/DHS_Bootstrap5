<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\ImageBlob;
use App\Models\Officer;
use App\Models\Rank;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class OfficerController extends Controller
{

    protected function badge($characters, $type)
    {
        $code = '';
        switch ($type) {
            case 'Liason':
                $code = 'LO';
                break;

            case 'Interpreter':
                $code = 'IO';
                break;

            case 'Receiving':
                $code = 'RO';
                break;

            default:
                $code = 'DL';
                break;
        };
        $possible = '0123456789';
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
    // protected function documentUpload($file, $id)
    // {
    //     $pdfBlob = file_get_contents($file->getRealPath());
    //     $pdf = new Document();
    //     $pdf->pdf_blob = $pdfBlob;
    //     $pdf->uid = $id;
    //     $pdfSaved = $pdf->save();
    //     return $pdfSaved;
    // }
    protected function imageBlobUpload($file, $id)
    {
        $imageBlob = $file;
        $imgBlob = new ImageBlob();
        $imgBlob->img_blob = $imageBlob;
        $imgBlob->uid = $id;
        $imgSaved = $imgBlob->save();
        return $imgSaved;
    }
    // protected function documentUpdate($file, $id)
    // {
    //     $pdfBlob = file_get_contents($file->getRealPath());
    //     $updatePdfBlob = Document::where('uid', $id)->first() ? Document::where('uid', $id)->update(['pdf_blob' => $pdfBlob]) : $this->documentUpload($file, $id);
    //     return $updatePdfBlob;
    // }
    protected function imageBlobUpdate($file, $id)
    {
        $imageBlob = $file;
        $updateImageBlob = ImageBlob::where('uid', $id)->first() ? ImageBlob::where('uid', $id)->update(['img_blob' => $imageBlob]) : $this->imageBlobUpload($file, $id);
        return $updateImageBlob;
    }

    public function addOfficer(Request $req)
    {
        $officer = new Officer();
        $officer->officer_uid  = (string) Str::uuid();
        $officer->officer_rank = $req->officer_rank;
        $officer->officer_designation = $req->officer_designation;
        $officer->officer_first_name = $req->officer_first_name;
        $officer->officer_last_name = $req->officer_last_name;
        $officer->officer_contact = $req->officer_contact;
        $officer->officer_identity = $req->officer_identity;
        $officer->officer_type  = $req->officer_type;
        $officer->officer_address  = $req->officer_address;
        $officer->officer_remarks  = $req->officer_remarks;
        $officer->officerCode  = $this->badge(8, $req->officer_type);
        try {
            $officerSaved = $officer->save();
            $imgSaved = $req->savedpicture ? $this->imageBlobUpload($req->savedpicture, $officer->officer_uid) : '';
            // $pdfSaved = $req->file('pdf') ? $this->documentUpload($req->file('pdf'), $officer->officer_uid) : '';
            if ($officerSaved) {
                return back()->with('message', 'Officer has been added Successfully');
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
    public function updateOfficer(Request $req, $id)
    {
        $arrayToBeUpdate = [];
        foreach ($req->all() as $key => $value) {
            if ($key != 'submit' && $key != '_token' && $key != 'savedpicture'  && $key != 'picture' && $key != 'officer_picture' && $key != 'pdf' && strlen($value) > 0) {
                $arrayToBeUpdate[$key] = $value;
            }
        }
        try {

            $officerUpdate = Officer::where('officer_uid', $id)->update($arrayToBeUpdate);
            // $pdfUpdate = $req->pdf ? $this->documentUpdate($req->file('pdf'), $id) : 0;
            $imgUpdate = $req->savedpicture ? $this->imageBlobUpdate($req->savedpicture, $id) : 0;
            if ($officerUpdate) {
                return back()->with('message', 'Officer has been updated Successfully');
            }
        } catch (QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }

    public function renderOfficer()
    {
        return view('pages.officers');
    }

    public function attachOfficer(Request $req)
    {
        $liasons = $req->liasonSelect;
        $receivings = $req->recievingSelect;
        $interpreters = $req->interpreterSelect;
        $delegationUid = $req->delegationUid_officer;
        foreach ($liasons as $key => $liason) {
            Officer::where('officer_uid', $liason)->update(['officer_delegation' => $delegationUid, 'officer_assign' => 1]);
        }
        foreach ($receivings as $key => $receiving) {
            Officer::where('officer_uid', $receiving)->update(['officer_delegation' => $delegationUid, 'officer_assign' => 1]);
        }
        foreach ($interpreters as $key => $interpreter) {
            Officer::where('officer_uid', $interpreter)->update(['officer_delegation' => $delegationUid, 'officer_assign' => 1]);
        }
        // return [$liason,$receiving,$interpreter,$delegationUid];
    }
    public function detachOfficerData($id){
        $officers = Officer::where('officer_delegation', $id)->get();
        return $officers;
    }
    public function detachOfficer(Request $req)
    {
        $officers = $req->officers;
        $delegationUid = $req->delegationUid_officer;
        foreach ($officers as $key => $officers) {
            Officer::where('officer_delegation', $delegationUid)->update(['officer_delegation' => null, 'officer_assign' => 0]);
        }
        // return [$liason,$receiving,$interpreter,$delegationUid];
    }

    public function officerData($id = null)
    {
        $officers = $id ? Officer::where([['officer_status', 1], ['officer_uid', $id]])->get() : Officer::where('officer_status', 1)->get();
        foreach ($officers as $key => $officer) {
            $officers[$key]->officer_rank = Rank::where('ranks_uid', $officer->officer_rank)->first();
            $officers[$key]->officer_picture = ImageBlob::where('uid', $officer->officer_uid)->first();
            // if ($id) {
            //     $officers[$key]->officer_document = Document::where('uid', $officer->officer_uid)->first();
            // }
        }
        return $officers;
    }

    public function addOfficerPage($id = null)
    {
        if ($id) {
            $officer = $this->officerData($id);
            return view('pages.addOfficer', ['officer' => $officer[0]]);
        } else {
            return view('pages.addOfficer');
        }
    }
}

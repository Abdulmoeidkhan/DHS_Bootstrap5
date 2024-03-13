<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;

// use Illuminate\Http\Response;
// use Response;
use Illuminate\Support\Facades\Auth;

class DoucmentController extends Controller
{
    protected function hisOwnProfile($uid)
    {
        if ($uid == auth()->user()->uid) {
            $user = User::with('roles', 'permissions')->where('id', Auth::user()->id)->first();
            $user->images = Document::where('uid', Auth::user()->uid)->first();
            session()->put('user', $user);
            return true;
        } else {
            return false;
        }
    }
    public function uploadDocument(Request $req)
    {
        // Validate the request.

        $file = $req->file('pdf');

        // Convert the image to base64.
        $type = $file->extension();
        $pdfBlob = file_get_contents($file);

        // Store the base64 image in the database.

        $pdf = new Document();
        $pdf->pdf_blob = $pdfBlob;
        $pdf->uid = $req->id;

        if (Document::where('uid', $req->id)->first()) {
            Document::where('uid', $req->id)->update(['pdf_blob' => $pdfBlob]);
            return $this->hisOwnProfile($req->id) ? redirect()->back()->with('message', "Document Has been updated") : redirect()->back()->with($req->id, "message", "Document Has been updated");
        } else {
            $pdf->save();
            return $this->hisOwnProfile($req->id) ? redirect()->back()->with('message', "Document Has been updated") : redirect()->back()->with($req->id, "message", "Document Has been updated");
        }
    }
    public function getPdf(Request $req, $id)
    {
        $getPdf = Document::where('uid', $id)->first();
        return FacadesResponse::make($getPdf->pdf_blob, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename=filename.pdf',
        ]);
    }
}

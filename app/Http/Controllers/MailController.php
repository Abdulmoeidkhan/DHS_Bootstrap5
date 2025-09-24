<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delegate;
use App\Models\Delegation;
use App\Models\Rank;
use App\Models\Vips;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;

class MailController extends Controller
{
    public function send_html_email($id)
    {
        try {
            $host = request()->getHttpHost();
            $delegate = Delegate::where('delegation', $id)->orWhere('delegates_uid', $id)->first();
            $delegation = Delegation::where('uid', $delegate->delegation)->first();
            $delegate->rankName = Rank::where('ranks_uid', $delegate->rank)->first();
            $delegate->invitedByDesignation = Vips::where('vips_uid', $delegation->invited_by)->first('vips_designation');
            $data = array('email' => $delegation->email_address, 'host' => $host, 'delegation' => $delegation, 'delegate' => $delegate);
            $email_address = $delegation->email_address;
            Mail::send('pages.mails.invitation', $data, function ($message) use ($email_address) {
                $message->to($email_address, "DHS")->subject('Invitation Details');
                $message->bcc("abdul.moeid@badarexpo.com", "DHS")->subject('Invitation Details');
                $message->bcc("pimeccoordination2025@gmail.com", "DHS")->subject('Invitation Details');
                $message->bcc("suleman.ahmed@badarexpo.com", "DHS")->subject('Invitation Details');
                $message->from("noreply.badarvms@gmail.com", "Invitation");
            });
            return true;
        } catch (QueryException $exception) {
            print_r($exception->errorInfo);
        }
    }
    public function send_html_email_on_given_email($id, Request $request)
    {
        try {
            $host = request()->getHttpHost();
            $delegate = Delegate::where('delegation', $id)->orWhere('delegates_uid', $id)->first();
            $delegation = Delegation::where('uid', $delegate->delegation)->first();
            $delegate->rankName = Rank::where('ranks_uid', $delegate->rank)->first();
            $delegate->invitedByDesignation = Vips::where('vips_uid', $delegation->invited_by)->first('vips_designation');
            $data = array('email' => $delegation->email_address, 'host' => $host, 'delegation' => $delegation, 'delegate' => $delegate);
            $email_address = $request->recipient;

            // Load the Blade view with data
            $pdf = Pdf::loadView('pages.mails.invitation', [
                'delegate' => $delegate,
                'delegation' => $delegation,
            ]);

            // Optional: Save PDF to storage if needed
            $pdfPath = storage_path("app/public/email_invitation_{$id}.pdf");
            $pdf->save($pdfPath);


            // Mail::send('pages.mails.invitation', $data, function ($message) use ($email_address) {
            //     $message->to($email_address, "DHS")->subject('Invitation Details');
            //     $message->bcc("abdul.moeid@badarexpo.com", "DHS")->subject('Invitation Details');
            //     // $message->bcc("pimeccoordination2025@gmail.com", "DHS")->subject('Invitation Details');
            //     // $message->bcc("suleman.ahmed@badarexpo.com", "DHS")->subject('Invitation Details');
            //     $message->from("noreply.badarvms@gmail.com", "Invitation");
            // });

            // Send Email with PDF attached
            Mail::send('pages.mails.invitation', $data, function ($message) use ($email_address, $pdfPath) {
                $message->to($email_address, "DHS")->subject('PIMEC 2025 Invitation')->attach($pdfPath, [
                    'as' => 'Invitation.pdf',
                    'mime' => 'application/pdf',
                ]);;
                $message->bcc("abdul.moeid@badarexpo.com", "DHS")->subject('PIMEC 2025 Invitation')
                    ->attach($pdfPath, [
                        'as' => 'Invitation.pdf',
                        'mime' => 'application/pdf',
                    ]);
            });


            return response()->json(['success' => true, 'message' => 'Email sent successfully.']);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email.',
                'error' => $exception->getMessage(),
                'errorInfo' => $exception->errorInfo
            ]);
        }
    }
}

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
            $email_address=$delegation->email_address;
            Mail::send('pages.mails.invitation', $data, function ($message) use ($email_address) {
                $message->to($email_address, "DHS")->subject('Invitation Details');
                $message->bcc("abdul.moeid@badarexpo.com", "DHS")->subject('Invitation Details');
                $message->from("noreply.badarvms@gmail.com", "Invitation");
            });
            return true;
        } catch (QueryException $exception) {
            print_r($exception->errorInfo);
        }
    }
}

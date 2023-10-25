<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Delegate;
use App\Models\Delegation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivateProfileController extends Controller
{
    protected function activateDelegate($recievedParams)
    {
        $delegate = new Delegate();
        $delegationUid = Delegation::where('delegationCode', 'DL' . $recievedParams->activationCode . '')->get('uid');
        $delegate->uid = (string) Str::uuid();
        $delegate->user_uid = $recievedParams->uid;
        $delegate->delegation = $delegationUid;
        try {
            $savedDelegate = $delegate->save();
            return $savedDelegate;
        //     $updatesDone = $savedDelegate ? Delegation::where('delegationCode', 'DL' . $recievedParams->activationCode . '')->update(['delegates' => $recievedParams->uid]) : false;
        //     return $updatesDone;
        } catch (\Illuminate\Database\QueryException $exception) {
            if ($exception->errorInfo[2]) {
                return  back()->with('error', 'Error : ' . $exception->errorInfo[2]);
            } else {
                return  back()->with('error', $exception->errorInfo[2]);
            }
        }
    }
    public function activateProfile(Request $req)
    {
        switch ($req->prefixSelect) {
            case "DL":
                // $delegateActivated = $this->activateDelegate($req);
                return $this->activateDelegate($req);
                // return $delegateActivated ? back()->with('message', 'Delegation Updated Successfully') : "Not Working";
                break;
            case "blue":
                echo "Your favorite color is blue!";
                break;
            case "green":
                echo "Your favorite color is green!";
                break;
            default:
                return back()->with('error', 'Something Went Wrong');
        }
    }
}

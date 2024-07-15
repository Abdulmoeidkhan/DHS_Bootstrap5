<?php

namespace App\Livewire;

use App\Http\Controllers\MailOtpController;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\Attributes\On;

class OtpResendComponent extends Component
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

    public $otpEmail;
    public $compName;
    public $showformComponent = false;
    public $otpSend = false;

    public function showForm()
    {
        $this->showformComponent = true;
        $this->dispatch('showStateUpdate')->self();
    }

    public function save()
    {
        try {
            $userUpdate = User::where("email", $this->otpEmail)->update(['activation_code' => $this->badge(8, '')]);
            if ($userUpdate) {
                $user = User::where("email", $this->otpEmail)->first();
                $emailSent = (new MailOtpController)->html_email($user->uid);
                return $emailSent ? true : false;
            }
        } catch (QueryException $exception) {
            print_r($exception->errorInfo);
        }
    }

    #[On('showStateUpdate')]
    public function render()
    {
        return view('livewire.otp-resend-component');
    }
}

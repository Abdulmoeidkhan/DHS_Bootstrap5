<?php

namespace App\Livewire;

use App\Models\Delegation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class UserListComponent extends Component
{
    public $users;
    public $code;

    public function mount()
    {
        $this->users = User::with('roles')->where('id', '!=', Auth::user()->id)->get();
        foreach ($this->users as $index => $user) {
            if ($user->roles[0]->name == 'delegate') {
                $this->users[$index]->code=Delegation::where('user_uid',$user->uid)->first('delegationCode');
            }
        }
        // foreach ($this->users as $index => $user) {
        //     switch ($this->users[$index]->roles[0]->display_name) {
        //         case "Delegate":
        //             $this->users[$index]->code = Delegation::where('user_uid', $user->uid)->first('delegationCode');
        //             break;
        //             // case "Liason":
        //             //     $this->code = Delegation::where('user_uid', $this->users->uid)->first('delegationCode');
        //             //     break;
        //             // case "LO":
        //             //     $officerActivated = $this->activateOfficer($req);
        //             //     return $officerActivated ? redirect()->back()->with('message', 'Officer Updated Successfully') : redirect()->back()->with('error', 'Officer already assigned');
        //             //     break;
        //             // case "RO":
        //             //     $officerActivated = $this->activateOfficer($req);
        //             //     return $officerActivated ? redirect()->back()->with('message', 'Officer Updated Successfully') : redirect()->back()->with('error', 'Officer already assigned');
        //             //     break;
        //             // case "IO":
        //             //     $officerActivated = $this->activateOfficer($req);
        //             //     return $officerActivated ? redirect()->back()->with('message', 'Officer Updated Successfully') : redirect()->back()->with('error', 'Officer already assigned');
        //             //     break;
        //             // case "AP":
        //             //     $airportOperator = $this->activateAirportOperator($req);
        //             //     return $airportOperator ? redirect()->back()->with('message', 'Airport Operator Updated Successfully') : redirect()->back()->with('error', 'Operator already assigned');
        //             //     break;
        //             // case "CA":
        //             //     $carOperator = $this->activateCarOperator($req);
        //             //     return $carOperator ? redirect()->back()->with('message', 'Car Operator Updated Successfully') : redirect()->back()->with('error', 'Operator already assigned');
        //             //     break;
        //         default:
        //             return '';
        //     }
        // }
    }

    #[On('addUser')]
    public function render()
    {
        return view('livewire.user-list-component');
    }
}

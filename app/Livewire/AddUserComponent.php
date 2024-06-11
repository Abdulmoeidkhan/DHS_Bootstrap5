<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate; 
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MailOtpController;

class AddUserComponent extends Component
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
    protected function basicRolesAndTeams($user)
    {
        $team = Team::where('name', 'user')->first();
        $role = Role::where('name', 'user')->first();
        $permission = Permission::where('name', 'read')->first();
        $user->addRole($role, $team);
        $user->givePermission($permission, $team);
    }

    public $savedUser = 0;

    #[Validate('required')]
    public $email = '';
    #[Validate('required')]
    public $username = '';
    #[Validate('required')]
    public $password = '';
    #[Validate('required')]
    public $confirmPassword = '';

    public function save()
    {
        $uid = (string) Str::uuid();
        $user = new User();
        $user->uid = $uid;
        
        $user->name = $this->username;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->activation_code = $this->badge(8, "");
        $user->activated = 1;
        $this->savedUser = $user->save();
        if ($this->savedUser) {
            $this->basicRolesAndTeams($user);
            $this->reset();
            $this->dispatch('addUser')->to(UserListComponent::class);
            $this->js("alert('User Added Successfully!')");
        }
    }


    #[On('addUser')]
    public function render()
    {
        return view('livewire.add-user-component');
    }
}

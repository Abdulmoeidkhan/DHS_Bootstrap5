<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;

class UserUpdateComponent extends Component
{
    public $userStatus;
    public $user;
    public function deleteId(Request $req)
    {
        User::where('uid', $this->user->uid)->update(['status' => 0]);
        $updatedUser = User::where('uid', $this->user->uid)->first();
        // $updated = $user ? 'User Deleted' : 'User Not found';
        // return redirect()->route('userPanel')->with('error', $updated);
        // $this->userStatus = $updatedUser;
        $this->dispatch('userStatusUpdate')->to(UserStatusComponent::class); 
        $this->userStatus = $updatedUser->status;
    }

    public function restoreId(Request $req)
    {
        User::where('uid', $this->user->uid)->update(['status' => 1]);
        $updatedUser = User::where('uid', $this->user->uid)->first();
        // $updated = $user ? 'User Restore' : 'User Not found';
        // return redirect()->route('userPanel')->with('error', $updated);
        // $this->userStatus = $updatedUser;
        $this->dispatch('userStatusUpdate')->to(UserStatusComponent::class); 
        $this->userStatus = $updatedUser->status;
    }
    public function render()
    {
        return view('livewire.user-update-component');
    }
}

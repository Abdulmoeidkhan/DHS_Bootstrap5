<?php

namespace App\Livewire;

use App\Models\Delegate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;


class AddDelegateComponent extends Component
{
    public $delegationUsers='';
    public $userUid = '';
    public $country = '';
    public $rank = '';
    public $firstName = '';
    public $lastName = '';
    public $designation = '';
    public $organistaion = '';
    public $passport = '';
    public $savedDelegate;
    public function save()
    {
        $delegate = new Delegate();
        $delegate->uid = (string) Str::uuid();
        $delegate->user_uid = $this->userUid;
        $delegate->country = $this->country;
        $delegate->rank = $this->rank;
        $delegate->first_Name = $this->firstName;
        $delegate->last_Name = $this->lastName;
        $delegate->designation = $this->designation;
        $delegate->organistaion = $this->organistaion;
        $this->savedDelegate = $delegate->save();
        $this->dispatch('datasaveddelegation')->self();
        $this->dispatch('delegateChanged')->to(DelegateComponent::class);
        $this->reset();
    }
    #[On('datasaveddelegation')]
    public function render()
    {
        $this->delegationUsers = User::with(['roles' => function (Builder $query) {
            $query->where('name', 'delegates');
        }])->get();
        return view('livewire.add-delegate-component');
    }
}

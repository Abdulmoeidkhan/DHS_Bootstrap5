<?php

namespace App\Livewire;

use App\Models\Delegate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class AddDelegateComponent extends Component
{
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
        $delegate->firstName = $this->first_Name;
        $delegate->lastName = $this->last_Name;
        $delegate->designation = $this->designation;
        $delegate->organistaion = $this->organistaion;
        $delegate->passport = $this->passport;
        $this->savedDelegate = $delegate->save();
        $this->dispatch('datasaved')->self();
        $this->dispatch('delegateChanged')->to(DelegateComponent::class);
        $this->reset();
    }
    #[On('datasaved')]
    public function render()
    {
        return view('livewire.add-delegate-component');
    }
}

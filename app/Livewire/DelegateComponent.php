<?php

namespace App\Livewire;

use App\Models\Delegate;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class DelegateComponent extends Component
{
    public $delegates;

    #[On('delegateChanged')]
    public function render()
    {
        $this->delegates = Delegate::whereNull('delegation')->get();
        return view('livewire.delegate-component');
    }
}

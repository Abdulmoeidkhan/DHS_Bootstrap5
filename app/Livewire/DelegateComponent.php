<?php

namespace App\Livewire;

use App\Models\Delegate;
use Livewire\Component;
use Livewire\Attributes\On;

class DelegateComponent extends Component
{
    public $delegates;
    
    #[On('delegateChanged')]
    public function render()
    {
        $this->delegates = Delegate::where('delegation','')->get();
        return view('livewire.delegate-component');
    }
}

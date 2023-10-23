<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Vips;

class InvitedByComponent extends Component
{
    public $vips = '';

    #[On('vipchanged')]
    public function render()
    {
        $this->vips = Vips::all();
        return view('livewire.invited-by-component');
    }
}

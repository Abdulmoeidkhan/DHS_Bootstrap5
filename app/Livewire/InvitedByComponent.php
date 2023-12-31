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
        $this->vips = Vips::where('status',1)->get();
        return view('livewire.invited-by-component');
    }
}

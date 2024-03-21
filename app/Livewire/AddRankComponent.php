<?php

namespace App\Livewire;

use App\Models\Rank;
use Livewire\Component;
use Illuminate\Support\Str;

class AddRankComponent extends Component
{
    public $rank = '';
    public $savedrank = 0;
    public function save()
    {
        $rank = new Rank();
        $rank->ranks_uid = (string) Str::uuid();
        $rank->ranks_name = $this->rank;
        $this->savedrank = $rank->ranks_name ? $rank->save() : false;
        // $this->dispatch('ranksaved')->self();
        $this->savedrank ? $this->dispatch('ranksaved')->to(AddVipsComponent::class) : '';
        $this->savedrank ? $this->reset() : '';
    }
    // #[On('ranksaved')]
    public function render()
    {
        return view('livewire.add-rank-component');
    }
}

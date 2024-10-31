<?php

namespace App\Livewire;

use App\Models\Rank;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Illuminate\Database\QueryException;

class AddRankComponent extends Component
{
    public $rank = '';
    public $savedrank = 0;
    public $errorStatus = false;
    public $errorMsg = '';
    public function save()
    {
        $rank = new Rank();
        $rank->ranks_uid = (string) Str::uuid();
        $rank->ranks_name = $this->rank;
        try {
            $this->savedrank = $rank->ranks_name ? $rank->save() : false;
            if ($this->savedrank) {
                $this->dispatch('ranksaved')->to(AddVipsComponent::class);
                $this->reset();
            }
        } catch (QueryException $exception) {
            $this->errorMsg = $exception->errorInfo[2];
            $this->errorStatus = true;
        }
        // $this->dispatch('ranksaved')->self();
    }
    #[On('ranksaved')]
    public function render()
    {
        return view('livewire.add-rank-component');
    }
}

<?php

namespace App\Livewire;

use App\Models\Vips;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;


class AddVips extends Component
{
    public $name = '';
    public $designation = '';
    public $rank = '';
    public $savedvip=0;
    public function save()
    {
        $vip = new Vips();
        $vip->uid = (string) Str::uuid();
        $vip->rank = $this->rank;
        $vip->name = $this->name;
        $vip->designation = $this->designation;
        $this->savedvip = $vip->save();
        // Vips::create(
        //     $this->only(['name', 'designation','rank','uid'])
        // );

        // return $this->redirect('/posts')
        //     ->with('status', 'Post successfully created.');
        $this->dispatch('datasaved')->self();
        return $this->savedvip;
    }
    #[On('datasaved')]
    public function render()
    {
        return view('livewire.add-vips');
    }
}

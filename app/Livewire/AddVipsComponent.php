<?php

namespace App\Livewire;

use App\Models\Vips;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;


class AddVipsComponent extends Component
{
    public $name = '';
    public $designation = '';
    public $rank = '';
    public $savedvip = 0;
    public function save()
    {
        $vip = new Vips();
        $vip->vips_uid = (string) Str::uuid();
        $vip->vips_rank = $this->rank;
        $vip->vips_name = $this->name;
        $vip->vips_designation = $this->designation;
        $this->savedvip = $vip->save();
        // Vips::create(
        //     $this->only(['name', 'designation','rank','uid'])
        // );

        // return $this->redirect('/posts')
        //     ->with('status', 'Post successfully created.');
        // $this->dispatch('datasaved')->self();
        $this->dispatch('vipchanged')->to(InvitedByComponent::class);
        $this->reset();
    }
    #[On('ranksaved')]
    public function render()
    {
        return view('livewire.add-vips-component');
    }
}

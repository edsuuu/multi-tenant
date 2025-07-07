<?php

namespace App\Livewire\Scheduling\Profile;

use App\Models\Plans;
use Livewire\Component;

class PlansProfile extends Component
{
    public $plans = [];

    public function mount()
    {
        $this->plans = Plans::all();
    }

    public function render()
    {
        return view('livewire.scheduling.profile.plans-profile');
    }
}

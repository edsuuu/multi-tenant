<?php

namespace App\Livewire\Scheduling;

use App\Models\Plans;
use Livewire\Component;

class HomePage extends Component
{
    public $plans = [];
    public function mount()
    {
        $this->plans = Plans::all();
    }

    public function render()
    {
        return view('livewire.scheduling.home-page');
    }
}

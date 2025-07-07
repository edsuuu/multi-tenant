<?php

namespace App\Livewire\Scheduling\Business;

use Livewire\Component;

class PageBusiness extends Component
{
    public $slug;

    public function mount($business_slug)
    {


        $this->slug = $business_slug;
        dd($business_slug);
    }

    public function render()
    {
        return view('livewire.scheduling.business.page-business');
    }
}

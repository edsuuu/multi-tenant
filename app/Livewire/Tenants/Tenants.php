<?php

namespace App\Livewire\Tenants;

use App\Models\Tenant;
use Livewire\Component;
use Livewire\WithPagination;

class Tenants extends Component
{
    use WithPagination;

    public function getTenants()
    {
        return Tenant::query()
            ->with('domain')
            ->orderBy('name')
            ->select('id', 'name', 'documents');
    }

    public function render()
    {
        $tenants = $this->getTenants()->paginate(10);
        return view('livewire.tenants.tenants', ['tenants' => $tenants]);
    }
}

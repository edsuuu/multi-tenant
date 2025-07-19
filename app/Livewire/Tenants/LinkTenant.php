<?php

namespace App\Livewire\Tenants;

use App\Livewire\Tenants\Forms\FormLinkTenant;
use App\Models\Tenant;
use App\Traits\WithUIEvents;
use Livewire\Attributes\Url;
use Livewire\Component;

class LinkTenant extends Component
{
    use WithUIEvents;


    #[Url('edit')]
    public $edit = false, $openLateralEdit = false;

    public $tenant;

    public function mount($uuidTenant)
    {
        if (auth()->check() && $this->edit) {
            $this->openLateralEdit = true;
        }

        if ($uuidTenant) {
            $this->tenant = Tenant::query()
                ->where('id', $uuidTenant)
                ->first();

        }

    }


    public function getCep()
    {

    }


    public function openModalEdit(): void
    {
        $arguments = ['tenantId' => $this->tenant->id];
        self::openModalRight($this, FormLinkTenant::class, $arguments);
    }




    public function render()
    {
        return view('livewire.tenants.link-tenant');
    }
}

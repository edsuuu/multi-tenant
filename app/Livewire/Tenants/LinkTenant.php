<?php

namespace App\Livewire\Tenants;

use App\Livewire\Tenants\Forms\FormLinkTenant;
use App\Models\Tenant;
use App\Traits\WithUIEvents;
use Livewire\Attributes\On;
use Livewire\Component;

class LinkTenant extends Component
{
    use WithUIEvents;

    public $openLateralEdit = false;

    public $uuid, $tenant, $qString, $orderedActiveDays;

    public function mount($uuidTenant)
    {
        if (auth()->check()) {
            $this->openLateralEdit = true;
        }

        $this->uuid = $uuidTenant;
        $this->getInfoTenant();
    }

    #[On('refreshTenantLinkMain')]
    public function getInfoTenant(): void
    {
        $this->tenant = Tenant::query()
            ->where('id', $this->uuid)
            ->first();

        $address = $this->tenant?->address ? str_replace(' ', '+', $this->tenant?->address) : "";
        $city = $this->tenant?->city ? str_replace(' ', '+', $this->tenant?->city) : "";
        $this->qString =  "{$address},+{$this->tenant?->number}+-+{$city}+{$this->tenant?->uf},+{$this->tenant?->zipCode}";

        $orderedDays = collect([
            'segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado', 'domingo'
        ]);

        $tenantDays = collect($this->tenant->days ?? []);

        $this->orderedActiveDays = $orderedDays->filter(fn($day) => $tenantDays->get($day) === true);
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

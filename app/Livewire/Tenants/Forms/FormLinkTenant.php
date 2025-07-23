<?php

namespace App\Livewire\Tenants\Forms;

use App\Models\Tenant;
use App\Services\CepFinderService;
use App\Traits\WithUIEvents;
use Livewire\Component;

class FormLinkTenant extends Component
{
    use WithUIEvents;

    public $tenant;
    public $titleTenant, $since, $description = '', $whatsapp, $instagram, $facebook, $youtube, $tiktok;

    public array $address = [
        'zip_code' => '',
        'street' => '',
        'neighborhood' => '',
        'complement' => '',
        'number' => '',
        'city' => '',
        'uf' => '',
    ];

    public array $days = [
        'segunda' => false,
        'terça' => false,
        'quarta' => false,
        'quinta' => false,
        'sexta' => false,
        'sábado' => false,
        'domingo' => false,
    ];

    public array $hours = [
        'segunda' => ['start' => '', 'end' => ''],
        'terça' => ['start' => '', 'end' => ''],
        'quarta' => ['start' => '', 'end' => ''],
        'quinta' => ['start' => '', 'end' => ''],
        'sexta' => ['start' => '', 'end' => ''],
        'sábado' => ['start' => '', 'end' => ''],
        'domingo' => ['start' => '', 'end' => ''],
    ];

    public function mount($tenantId)
    {
        $tenant = Tenant::query()
            ->where('id', $tenantId)
            ->first();

        if ($tenant) {
            $this->tenant = $tenant;
            $this->titleTenant = $tenant->title;
            $this->since = $tenant->since;
            $this->description = $tenant->description;
            $this->whatsapp = $tenant->whatsapp;
            $this->tiktok = $tenant->tiktok;
            $this->youtube = $tenant->youtube;
            $this->facebook = $tenant->facebook;
            $this->instagram = $tenant->instagram;
            $this->address['zip_code'] = $tenant->zip_code;
            $this->address['street'] = $tenant->address;
            $this->address['city'] = $tenant->city;
            $this->address['uf'] = $tenant->uf;
            $this->address['number'] = $tenant->number;
            $this->address['neighborhood'] = $tenant->neighborhood;
            $this->address['complement'] = $tenant->complement;

            if (isset($tenant->days)) {
                foreach ($tenant->days as $key => $day) {
                    $this->days[$key] = $day;
                }
            }

            if (isset($tenant->hours)) {
                foreach ($this->hours as $dia => $valores) {
                    if (isset($tenant->hours[$dia])) {
                        $this->hours[$dia] = [
                            'start' => $tenant->hours[$dia]['start'] ?? '',
                            'end' => $tenant->hours[$dia]['end'] ?? '',
                        ];
                    }
                }
            }
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'address.zip_code') {
            $address = CepFinderService::getAddress($this->address['zip_code']);

            if (!$address) {
                return $this->addError('address.zip_code', 'Cep inválido');
            }

            $this->address['zip_code'] = $address['cep'];
            $this->address['street'] = $address['street'];
            $this->address['neighborhood'] = $address['neighborhood'];
            $this->address['city'] = $address['city'];
            $this->address['uf'] = $address['state'];
        }
    }

    public function save(): void
    {
        $validate = $this->validate([
            'titleTenant' => 'required',
            'since' => 'required',
            'description' => 'required',
            'address.zip_code' => 'required',
            'address.street' => 'required',
            'address.neighborhood' => 'required',
            'address.number' => 'required',
            'address.city' => 'required',
            'address.uf' => 'required',
            'address.complement' => 'sometimes|nullable',
            'whatsapp' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255|url',
            'facebook' => 'nullable|string|max:255|url',
            'youtube' => 'nullable|string|max:255|url',
            'tiktok' => 'nullable|string|max:255|url',
            'days' => 'required|array',
            'days.*' => 'boolean',
            'hours' => 'required|array',
            'hours.*.start' => 'required_if:days.*,true|date_format:H:i',
            'hours.*.end' => 'required_if:days.*,true|date_format:H:i|after:hours.*.start'
        ], [
            'required' => 'Obrigatorio',
            'url' => 'URL inválida',
            'date_format' => 'Formato de hora inválido',
            'after' => 'Hora final deve ser maior que hora inicial',
            'required_if' => 'O campo :attribute é obrigatório quando estiver selecionado.',
        ], [
            'titleTenant' => 'Título principal',
            'since' => 'Desde o ano',
            'description' => 'Descrição',
            'address.zip_code' => 'CEP',
            'address.street' => 'Rua',
            'address.neighborhood' => 'Bairro',
            'address.number' => 'Número',
            'address.city' => 'Cidade',
            'address.uf' => 'Estado',
            'address.complement' => 'Complemento',
            'whatsapp' => 'WhatsApp',
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'youtube' => 'YouTube',
            'tiktok' => 'TikTok',
            'days' => 'Dias de atendimento',
            'hours.segunda.start' => 'Segunda - Início',
            'hours.segunda.end' => 'Segunda - Fim',
            'hours.terça.start' => 'Terça - Início',
            'hours.terça.end' => 'Terça - Fim',
            'hours.quarta.start' => 'Quarta - Início',
            'hours.quarta.end' => 'Quarta - Fim',
            'hours.quinta.start' => 'Quinta - Início',
            'hours.quinta.end' => 'Quinta - Fim',
            'hours.sexta.start' => 'Sexta - Início',
            'hours.sexta.end' => 'Sexta - Fim',
            'hours.sábado.start' => 'Sábado - Início',
            'hours.sábado.end' => 'Sábado - Fim',
            'hours.domingo.start' => 'Domingo - Início',
            'hours.domingo.end' => 'Domingo - Fim',
            'hours.domingo.*' => 'Domingo',
            'days.segunda.*' => 'Segunda',
            'days.terça.*' => 'Terça',
            'days.quarta.*' => 'Quarta',
            'days.quinta.*' => 'Quinta',
            'days.sexta.*' => 'Sexta',
            'days.sábado.*' => 'Sábado',
            'days.domingo.*' => 'Domingo',
        ]);

        $data = [
            'title' => $validate['titleTenant'],
            'since' => $validate['since'],
            'description' => $validate['description'],
            'whatsapp' => $validate['whatsapp'],
            'instagram' => $validate['instagram'],
            'facebook' => $validate['facebook'],
            'youtube' => $validate['youtube'],
            'tiktok' => $validate['tiktok'],
            'days' => $validate['days'],
            'hours' => $validate['hours'],
        ];

        Tenant::query()
            ->where('id', $this->tenant->id)
            ->update([
                'data' => $data,
                'zip_code' => $this->address['zip_code'],
                'address' => $this->address['street'],
                'neighborhood' => $this->address['neighborhood'],
                'number' => $this->address['number'],
                'city' => $this->address['city'],
                'complement' => $this->address['complement'] ?? null,
                'uf' => $this->address['uf'],
            ]);

        self::closeModalRight($this, ['refreshTenantLinkMain']);
    }

    public function render()
    {
        return view('livewire.tenants.forms.form-link-tenant');
    }
}

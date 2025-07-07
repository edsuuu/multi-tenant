<?php

namespace App\Livewire\Scheduling\Profile;

use App\Models\Business;
use App\Services\AddressService;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditBusiness extends Component
{
    public $name, $documents, $zipCode, $address, $number, $city, $state, $neighborhood, $documentType;

    public function mount()
    {
        $business = Business::find(auth()->user()->business->id);
        $this->name = $business->name;
        $this->documentType = $business->document_type;
        $this->documents = $business->documents;
        $this->zipCode = $business->zip;
        $this->address = $business->address;
        $this->number = $business->number_address;
        $this->city = $business->city;
        $this->state = $business->state;
        $this->neighborhood = $business->neighborhood;
    }

    public function updatedZipCode()
    {
        $address = AddressService::getAddress($this->zipCode);

        if (!$address) {
            $this->addError('zipCode', 'O  Cep informado não existe.');
        } else {
            $this->address = $address['address'] ?? '';
            $this->state = $address['st'] ?? '';
            $this->neighborhood = $address['neighborhood'] ?? '';
            $this->city = $address['city'] ?? '';
        }
    }

    public function saveBusiness()
    {
        $this->validate([
            'name' => 'required',
            'documentType' => 'sometimes|nullable',
            'documents' => ['required_with:documentType', 'nullable',
                Rule::when($this->documentType == 'CPF', 'cpf'),
                Rule::when($this->documentType == 'CNPJ', 'cnpj')],
            'zipCode' => 'required',
            'address' => 'required',
            'number' => 'required',
            'city' => 'required',
            'state' => 'required',
            'neighborhood' => 'required',
        ], [
            'required' => ':attribute é obrigatorio.',
            'documents.required_with' => 'O :attribute é obrigatório',
            'cpf' => 'O CPF não é valido',
            'cnpj' => 'O CNPJ não é valido',
        ], [
            'name' => 'Nome',
            'documentType' => 'Tipo de documento',
            'documents' => 'Documento',
            'zipCode' => 'CEP',
            'address' => 'Rua',
            'number' => 'Numero',
            'city' => 'Cidade',
            'state' => 'Estado',
            'neighborhood' => 'Bairro',
        ]);

        Business::find(auth()->user()->business->id)->update([
            'name' => $this->name,
            'document_type' => $this->documentType,
            'documents'=>  $this->documents,
            'address'=>  $this->address,
            'city'=>  $this->city,
            'state' => $this->state,
            'number' => $this->number,
            'neighborhood' => $this->neighborhood,
            'zip' => $this->zipCode,
        ]);

        $this->dispatch('successUpdateBusiness');
    }

    public function render()
    {
        return view('livewire.scheduling.profile.edit-business');
    }
}

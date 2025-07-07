<?php

namespace App\Livewire\Auth;

use App\Models\Business;
use App\Models\HoursWeeks;
use App\Models\Segments;
use App\Services\AddressService;
use Livewire\Component;

class CompleteProfile extends Component
{
    public $nameBusiness, $phone, $referralSource, $zipCode, $address, $number, $city, $state, $neighborhood, $selectedSegment;
    public $currentStep = 1;
    public $segments = [];
    public $daysByWeeks = [];
    public $workingHours = [];

    public $daysWeek =  ['Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado', 'Domingo'];

    public function mount()
    {
        $this->segments = Segments::orderBy('name', 'asc')->get();

        $dataStepOne = Business::query()->where('user_id', auth()->user()->id)->first();

        if (isset($dataStepOne->name) && isset($dataStepOne->zip) && isset($dataStepOne->number_address) && auth()->user()->phone) {
            $this->currentStep = 2;
        }

        if (isset($dataStepOne->segment_id)) {
            $this->currentStep = 3;
        }

        $this->getDates();
    }

    public function getDates()
    {
        foreach ($this->daysWeek as $day) {
            if (auth()->user()->business) {
                $this->daysByWeeks = collect(HoursWeeks::query()->where('business_id', auth()->user()->business->id)->get());

                $existingDay = $this->daysByWeeks->firstWhere('day', $day);

                if ($existingDay) {
                    $this->workingHours[$day] = [
                        'active' => (bool) $existingDay->active,
                        'start_time' => $existingDay->start_time,
                        'closing_time' => $existingDay->closing_time,
                    ];
                } else {
                    $this->workingHours[$day] = [
                        'active' => false,
                        'start_time' => '',
                        'closing_time' => '',
                    ];
                }
            } else {
                $this->workingHours[$day] = [
                    'active' => false,
                    'start_time' => '',
                    'closing_time' => '',
                ];
            }
        }
    }

    public function selectSegment($segment)
    {
        $this->selectedSegment = $segment;
    }

    public function nextStep()
    {
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function saveInitial()
    {
        $validatedData = $this->validate([
            'nameBusiness' => 'required|string|min:3|max:50',
            'phone' => 'required|min:14|max:15',
            'referralSource' => 'required',
            'address' => 'required',
            'zipCode' => 'required',
            'state' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'number' => 'required',
        ], [
            'required' => ':attribute é obrigatório.',
            'min' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
        ], [
            'nameBusiness' => 'Nome da Empresa',
            'phone' => 'Telefone',
            'referralSource' => 'Onde nos conheceu',
            'address' => 'Rua',
            'zipCode' => 'Cep',
            'state' => 'Estado',
            'neighborhood' => 'Bairro',
            'city' => 'Cidade',
            'number' => 'Número',
        ]);

        $user = auth()->user();

        $user->update([
            'phone' => '+55 ' . $validatedData['phone'],
        ]);

        $business = Business::create([
            'name' => $validatedData['nameBusiness'],
            'user_id' => auth()->user()->id,
            'address' => $validatedData['address'],
            'zip' => $validatedData['zipCode'],
            'state' => $validatedData['state'],
            'neighborhood' => $validatedData['neighborhood'],
            'city' => $validatedData['city'],
            'number_address' => $validatedData['number'],
            'referral_source' => $validatedData['referralSource'],
        ]);

        if ($business) {
            foreach ($this->daysWeek as $day) {
                HoursWeeks::updateOrCreate(
                    [
                        'day' => $day,
                        'business_id' => auth()->user()->business->id,
                    ],
                    [
                        'start_time' => '09:00',
                        'closing_time' => '19:00',
                    ]
                );
            }

            $this->currentStep = 2;
        }

        $this->getDates();
    }

    public function saveSegment()
    {
        $validatedData = $this->validate([
            'selectedSegment' => 'required',
        ],
            [
                'required' => 'Escolha pelo menos um segmento.',
            ], [
                'selectedSegment' => 'Segmento',
            ]
        );

        $update = Business::query()->where('user_id', auth()->user()->id)->update([
            'segment_id' => $validatedData['selectedSegment'],
        ]);

        if($update) {
            $this->currentStep = 3;
        }
    }

    public function saveWorkingHours()
    {
        foreach ($this->workingHours as $day => $workingHours) {
            HoursWeeks::query()
                ->where('business_id', auth()->user()->business->id)
                ->where('day', $day)
                ->update([
                    'active' => $workingHours['active'] ? 1 : 0,
                    'start_time' => $workingHours['start_time'],
                    'closing_time' => $workingHours['closing_time'],
                ]);
        }

        return redirect()->route('dashboard');
    }

//    HOOK do livewire quando o campo é atualizado ele chama essa função
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

    public function render()
    {
        return view('livewire.auth.complete-profile');
    }
}

<?php

namespace App\Livewire\Scheduling\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfile extends Component
{
    public $firstName, $lastName, $email, $cellphone;

    public function mount()
    {
        $this->firstName = Auth::user()->first_name;
        $this->lastName = Auth::user()->last_name;
        $this->email = Auth::user()->email;
        $this->cellphone = explode('+55', Auth::user()->phone)[1];
    }

    public function saveProfile()
    {
        $this->validate([
            'firstName' => 'required',
            'lastName'  => 'sometimes',
            'cellphone' => 'required',
        ], [
            'required' => ':attribute é obrigatório.',
        ], [
            'firstName' => 'Nome',
            'lastName'  => 'Sobrenome nome',
            'cellphone' => 'Celular',
        ]);

        $user = Auth::user();

        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;
        $user->phone = '+55' . $this->cellphone;

        $user->save();

        $this->dispatch('sucessUpdatedProfile');
    }
    public function render()
    {
        return view('livewire.scheduling.profile.edit-profile');
    }
}

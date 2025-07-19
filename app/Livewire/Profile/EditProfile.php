<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfile extends Component
{
    public $name, $email, $cellphone;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->cellphone = Auth::user()->cellphone;
    }

    public function saveProfile()
    {
        $this->validate([
            'name' => 'sometimes',
            'cellphone' => 'sometimes',
        ], [
            'required' => ':attribute é obrigatório.',
        ], [
            'name' => 'Nome',
            'cellphone' => 'Celular',
        ]);

        $user = Auth::user();

        $user->name = $this->name;
        $user->cellphone = $this->cellphone;

        $user->save();

        $this->dispatch('sucessUpdatedProfile');
    }
    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
}

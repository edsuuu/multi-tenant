<?php

namespace App\Livewire\Scheduling\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    public $currentPassword, $newPassword, $confirmNewPassword;

    public function saveNewPassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmNewPassword' => 'required|same:newPassword',
        ], [
            'required' => ':attribute é obrigatório.',
            'min' => 'A :attribute precisa ter no mínimo :min caracteres.',
            'same' => 'A confirmação da nova senha não corresponde.',
        ], [
            'currentPassword' => 'Senha atual',
            'newPassword' => 'Nova senha',
            'confirmNewPassword' => 'Confirmação da nova senha',
        ]);

        if (!Hash::check($this->currentPassword, Auth::user()->password)) {
            return $this->addError('currentPassword', 'Senha incorreta');
        }

        Auth::user()->update([
            'password' => Hash::make($this->newPassword),
        ]);

        $this->reset(['currentPassword', 'newPassword', 'confirmNewPassword']);

        $this->dispatch('successUpdatePassword');
    }


    public function render()
    {
        return view('livewire.scheduling.profile.reset-password');
    }
}

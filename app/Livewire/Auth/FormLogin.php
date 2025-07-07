<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class FormLogin extends Component
{
	public $formData = [
		'email' => '',
		'password' => '',
		'remember' => false,
	];

	public function handleChange($field): void
	{
		$this->resetErrorBag($field);
	}

	public function submit()
	{
        $validatedData = $this->validate([
            'formData.email' => 'required',
            'formData.password' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
        ], [
            'formData.email' => 'E-mail',
            'formData.password' => 'Senha',
        ]);

		if (Auth::check()) {
			return redirect('dashboard');
		}

		$remember = (bool)$this->formData['remember'];

		try {
			$user = User::where('email', $validatedData['formData']['email'])->first();

			if (!$user) {
				return $this->addError('formData.email', 'Conta não encontrada.');
			}

			if (!Hash::check($validatedData['formData']['password'], $user->password)) {
				return $this->addError('formData.password', 'Senha inválida.');
			}

			Auth::login($user, $remember);

			session()->regenerate();

			return redirect('dashboard');

		} catch (\Exception $e) {
			 return $this->addError('formData', 'Ocorreu um erro ao tentar fazer login. Tente novamente.');
		}
	}

	public function render()
	{
		return view('livewire.auth.form-login');
	}
}

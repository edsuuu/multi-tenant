<?php

namespace App\Livewire\Auth;

use App\Http\Controllers\AuthProvidersController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class FormLogin extends Component
{
    public $email, $password, $remember = false;

	public function handleChange($field): void
	{
		$this->resetErrorBag($field);
	}

	public function login()
	{
        $validatedData = $this->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
        ], [
            'email' => 'E-mail',
            'password' => 'Senha',
        ]);

		$remember = $this->remember;

		try {
            $user = User::query()
                ->with(['tenant.domain'])
                ->where('email', $validatedData['email'])
                ->first();

            if (!$user) {
                return $this->addError('email', 'Usuário ou senha inválida.');
            }

            if (!Hash::check($validatedData['password'], $user->password)) {
                return $this->addError('password', 'Usuário ou senha inválida.');
            }

            return AuthProvidersController::login($user->id, $user->tenant?->domain->domain, $remember);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Erro ao tentar fazer login em uma conta: email ' . $validatedData['email'] . 'erro' . $e);
            return $this->addError('forms', 'Ocorreu um erro ao tentar fazer login. Tente novamente.');
		}
	}

	public function render()
	{
		return view('livewire.auth.form-login');
	}
}

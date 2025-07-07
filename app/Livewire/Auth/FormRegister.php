<?php

namespace App\Livewire\Auth;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Stancl\Tenancy\Database\Models\Domain;

class FormRegister extends Component
{
    public $name, $email, $documents, $cellphone, $password, $passwordConfirmation, $domain, $nameBusiness;

    protected function rules()
    {
        $value = preg_replace('/\D/', '', $this->documents);

        return [
            'documents' => [
                Rule::when(strlen($value) === 11, 'cpf'),
                Rule::when(strlen($value) === 14, 'cnpj'),
            ],
        ];
    }

    protected function messages()
    {
        return [
            'documents.cpf' => 'O campo CPF inválido.',
            'documents.cnpj' => 'O campo CNPJ inválido.',
        ];
    }

    public function save()
    {
        if ($this->password !== $this->passwordConfirmation) {
            $this->addError('passwordConfirmation', 'As senhas não coincidem.');
            return;
        }


        $validatedData = $this->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^\s*\S+\s+\S+.*$/',
            ],
            'email' => 'required|email:rfc,dns|unique:users,email',
            'cellphone' => 'required',
            'documents' => [
                'required',
                Rule::when(strlen(preg_replace('/\D/', '', $this->documents)) === 11, 'cpf'),
                Rule::when(strlen(preg_replace('/\D/', '', $this->documents)) === 14, 'cnpj'),
            ],
            'password' => 'required|min:6',
            'domain' => [
                'required',
                'string',
                'min:3',
                'max:15',
                'regex:/^[a-z0-9-]+$/',
            ],
            'nameBusiness' => 'required|string|min:3|max:20',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'min' => 'O campo :attribute deve ter pelo menos :min caracteres.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'unique' => 'O campo :attribute já está cadastrado.',
            'regex' => 'O campo :attribute tem um formato inválido.',
            'name.regex' => 'Informe o nome completo',
            'domain.regex' => 'Formato inválido',
        ], [
            'name' => 'Nome completo',
            'email' => 'E-mail',
            'password' => 'Senha',
            'cellphone' => 'Celular',
            'domain' => 'Domínio',
            'nameBusiness' => 'Nome do comércio',
        ]);

        

        dd($validatedData);

        $tenant = Tenant::query()->where('domain', $this->domain)->first();

        $domain = Domain::query()->where('name');

        try {
            $user = User::create([
                'first_name' => $validatedData['formData']['firstName'],
                'last_name' => $validatedData['formData']['lastName'],
                'email' => $validatedData['formData']['email'],
                'password' => Hash::make($validatedData['formData']['password']),
                'role' => 'customer',
            ]);

            DB::commit();

            Auth::login($user);

            if (Auth::check()) {
                return redirect()->route('complete-profile');
            }

            return redirect()->route('login');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('auth')->debug('Erro ao tentar criar uma conta' . $e->getMessage());
            $this->addError('form', 'Ocorreu um erro ao tentar criar uma conta');
        }
	}

    public function handleChange($field): void
    {
        $this->resetErrorBag($field);
    }

    public function render()
    {
        return view('livewire.auth.form-register');
    }
}

<?php

namespace App\Livewire\Auth;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Stancl\Tenancy\Database\Models\Domain;

class FormRegister extends Component
{
    #[Validate]
    public $documents;
    public $name, $email, $cellphone, $password, $passwordConfirmation, $domain, $nameBusiness;

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
            return $this->addError('passwordConfirmation', 'As senhas não coincidem.');
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
            'documents' => 'CPF/CNPJ',
            'cellphone' => 'Celular',
            'domain' => 'Domínio',
            'nameBusiness' => 'Nome do comércio',
        ]);

        $user = User::query()
            ->where('email', $validatedData['email'])
            ->first();

        if ($user) {
            $this->addError('email', 'Já existe uma conta com este E-mail');
        }

        $tenant = Tenant::query()
            ->with('domain')
            ->where('documents', 'LIKE', '%' . $validatedData['documents'] . '%')
            ->first();

        if ($tenant) {
            $this->addError('documents', 'Já existe um Comercio com este CPF/CNPJ');
            return;
        }

        $concatUrl = $validatedData['domain'] . '.' . config('app.base_domain');

        $domain = Domain::query()
            ->where('domain', $concatUrl)
            ->first();

        if ($domain) {
            $this->addError('domain', 'Já existe um Comercio com este dominio');
            return;
        }

        $user = User::query()->create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'cellphone' => $validatedData['cellphone'],
        ]);

        $tenant = Tenant::query()->create([
            'id' => str()->uuid(),
            'name' => $validatedData['nameBusiness'],
            'main_user_id' => $user->id,
        ]);

        $domain = Domain::query()->create([
            'domain' => $concatUrl,
            'tenant_id' => $tenant->id,
        ]);

        $user->update(['tenant_id' => $tenant->id]);

        return redirect(tenant_route($domain->domain, 'home-tenant'));
//            Auth::login($user);
//
//            if (Auth::check()) {
//                return redirect()->route('complete-profile');
//            }
//
//            return redirect()->route('login');
//        } catch (\Exception $e) {
//            DB::rollBack();
//            Log::channel('auth')->debug('Erro ao tentar criar uma conta' . $e->getMessage());
//            $this->addError('form', 'Ocorreu um erro ao tentar criar uma conta');
//        }
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

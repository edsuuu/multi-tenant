<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;

class Users extends Component
{
    #[Url('uuid')]
    public $tenantId;

    public function mount()
    {

    }

    public function getUsers()
    {
        $users = User::query()
            ->with('tenant')
            ->where(function ($query) {
                // escopar as consultas por permissoes
                if (auth()->user()->tenant) {
                    $query->where('tenant_id', auth()->user()->tenant->id);
                } else if (auth()->user()->tenant === null) {
                    if ($this->tenantId) {
                        $query->where('tenant_id', $this->tenantId);
                    }
                } else {
                    $query->where('tenant_id', null);
                }
            })->orderBy('name');


        return $users;
    }

    public function render()
    {
        $users = $this->getUsers()->paginate(10);

        return view('livewire.users.users', ['users' => $users]);
    }
}

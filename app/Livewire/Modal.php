<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public array $components;
    public ?string $activeUuidComponent;

    public function resetState(): void
    {
        $this->components = [];
        $this->activeUuidComponent = null;
    }

    #[On('OpenModalComponent')]
    public function openModal(string $component, array $arguments = []): void
    {
        $id = md5($component . serialize($arguments));

        $this->components[$id] = [
            'name' => $component,
            'attributes' => $arguments,
            'arguments' => $arguments,
        ];

        $this->activeUuidComponent = $id;

        $this->dispatch('active-modal-component-changed', id: $id);
    }

    #[On('CloseModalComponent')]
    public function closeModal(): void
    {
        if ($this->activeUuidComponent) {
            $this->destroyComponent($this->activeUuidComponent);
            $this->activeUuidComponent = null;
        }


        $this->dispatch('close-modal');
    }

    private function dispatchModalEvents()
    {

    }

    private function destroyComponent($id): void
    {
        unset($this->components[$id]);
    }

    public function render()
    {
        return view('livewire.modal');
    }
}

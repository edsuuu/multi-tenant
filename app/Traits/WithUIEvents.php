<?php

namespace App\Traits;

use Livewire\Component;

/**
 * @mixin Component
 */

trait WithUIEvents
{
    public const EventModalRight = 'OpenModalComponent';



    private static function openModalRight(Component $livewireInstance, string $component, array $arguments = []): void
    {
        $livewireInstance->dispatch(self::EventModalRight, component: $component, arguments: $arguments);
    }

    private static function closeModalRight(): void
    {

    }

}

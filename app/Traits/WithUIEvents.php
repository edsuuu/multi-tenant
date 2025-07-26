<?php

namespace App\Traits;

use Livewire\Component;

/**
 * @mixin Component
 */

trait WithUIEvents
{
    private const EventOpenModalRight = 'OpenModalComponent';
    private const EventCloseModalRight = 'CloseModalComponent';

    private static function openModalRight(Component $livewireInstance, string $component, array $arguments = []): void
    {
        $livewireInstance->dispatch(self::EventOpenModalRight, component: $component, arguments: $arguments);
    }

    private static function closeModalRight(Component $livewireInstance, $events = []): void
    {
        $livewireInstance->dispatch(self::EventCloseModalRight, events: $events);
    }

}

<?php

namespace App\Traits;

use Livewire\Component;

/**
 * @mixin Component
 */

trait WithUIEvents
{
    public const EventOpenModalRight = 'OpenModalComponent';
    public const EventCloseModalRight = 'CloseModalComponent';

    private static function openModalRight(Component $livewireInstance, string $component, array $arguments = []): void
    {
        $livewireInstance->dispatch(self::EventOpenModalRight, component: $component, arguments: $arguments);
    }

    private static function closeModalRight(Component $livewireInstance, $events = []): void
    {
        $livewireInstance->dispatch(self::EventCloseModalRight, events: $events);
    }

}

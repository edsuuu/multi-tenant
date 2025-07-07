<?php

namespace App\Traits;

use Livewire\Component;

/**
 * @mixin Component
 */

trait WithModal
{
//    public function openModal($component, $params = [], $level = 1)
    public function openModal()
    {

//        $this->dispatch('showModal'.$level, component: $modal, params: [$component, $params]);
        $this->dispatch('chamaoDD');
    }


}

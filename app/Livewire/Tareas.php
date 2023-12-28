<?php

namespace App\Livewire;

use Livewire\Component;

class Tareas extends Component
{
    public $open = false;

    public $editOpen = false;

    public $destroyOpen = false;

    public $detailOpen = false;

    public function render()
    {
        return view('livewire.tareas');
    }
}

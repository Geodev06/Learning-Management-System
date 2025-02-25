<?php

namespace App\Livewire\Components;

use App\Events\MessageSent;
use App\Models\Module;
use Livewire\Component;

class ModuleHeader extends Component
{

    public $id;

  

    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $module = Module::find($this->id);
        return view('livewire.components.module-header', compact('module'));
    }
}

<?php

namespace App\Livewire\Components;

use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ModulesCard extends Component
{
    use WithPagination;

    #[On('list-refresh')]
    public function render()
    {

        $modules = Module::where(
            ['created_by' => Auth::user()->id]
        )->orderBy('created_at', 'desc')->paginate(12);

        return view('livewire.components.modules-card', compact('modules'));
    }
}

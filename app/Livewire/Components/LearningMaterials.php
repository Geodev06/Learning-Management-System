<?php

namespace App\Livewire\Components;

use App\Models\Module;
use Livewire\Component;

class LearningMaterials extends Component
{
   
    public function mount()
    {
        
    }

    public function render()
    {
        $learning_materials = Module::where([
            'active_flag' => 'Y',
            'post_flag' => 'Y'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('livewire.components.learning-materials', compact('learning_materials'));
    }
}

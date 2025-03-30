<?php

namespace App\Livewire\Components;

use App\Models\Module;
use Livewire\Component;

class LearningMaterials extends Component
{
    public $search_field = ''; // The search field variable

    public function mount() {}

    public function redirect_view($id)
    {
        $this->redirect(route('module_preview', $id), false);
    }

    public function render()
    {
        $learning_materials = Module::with('author')
            ->where([
                'active_flag' => 'Y',
                'post_flag' => 'Y'
            ])
            // Check if there is a search field value and apply filter
            ->when($this->search_field, function ($query) {
                $query->where('title', 'like', '%' . $this->search_field . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.components.learning-materials', compact('learning_materials'));
    }
}

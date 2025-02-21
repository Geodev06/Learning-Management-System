<?php

namespace App\Livewire\Components;

use App\Models\Module;
use App\Models\StudentModule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentModules extends Component
{


    public function redirect_learn($id)
    {
        $this->redirect(route('learn_module', $id));
    }
    
    public function render()
    {
        $module_ids = StudentModule::where('created_by', Auth::user()->id)->get();

        $modules = [];
        foreach ($module_ids as $data) {
            $modules[] = Module::find($data->module_id);
        }

        return view('livewire.components.student-modules', compact('modules'));
    }
}

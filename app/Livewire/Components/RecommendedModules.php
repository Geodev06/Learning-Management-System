<?php

namespace App\Livewire\Components;

use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecommendedModules extends Component
{
    public $user_org_code;

    public function mount()
    {
        $this->user_org_code = Auth::user()->org_code;
    }

    public function view_module($id)
    {
        $this->redirect(route('module_preview', $id));
    }

    public function render()
    {

        $learning_modality = Auth::user()->learning_modality;


        switch ($learning_modality) {
            case 'A':
                $learning_materials = Module::with('access')->where([
                    'active_flag' => 'Y',
                    'a_flag' => 1
                ])->whereHas('access', function ($query) {

                    $query->where('org_code', $this->user_org_code);
                })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                break;
            case 'R':
                $learning_materials = Module::with('access')->where([
                    'active_flag' => 'Y',
                    'r_flag' => 1
                ])->whereHas('access', function ($query) {

                    $query->where('org_code', $this->user_org_code);
                })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                break;
            case 'K':
                $learning_materials = Module::with('access')->where([
                    'active_flag' => 'Y',
                    'k_flag' => 1
                ])->whereHas('access', function ($query) {

                    $query->where('org_code', $this->user_org_code);
                })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                break;
            case 'V':
                $learning_materials = Module::with('access')->where([
                    'active_flag' => 'Y',
                    'v_flag' => 1
                ])->whereHas('access', function ($query) {

                    $query->where('org_code', $this->user_org_code);
                })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                break;
        }


        foreach ($learning_materials as $item) {
            $user = User::find($item->created_by); // Using find() for better performance
            if ($user) { // Check if user exists
                $item['author_name'] = base64_decode($user->first_name) . ' ' . base64_decode($user->last_name);
            }
        }

        return view('livewire.components.recommended-modules', compact('learning_materials'));
    }
}

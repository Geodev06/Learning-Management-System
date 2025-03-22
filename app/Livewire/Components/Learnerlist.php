<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Learnerlist extends Component
{

    use WithPagination;


    public function profile_preview($id)
    {
        $this->redirect(route('profile_preview', encrypt($id)));
    }

    public function render()
    {

        $users = User::where('role','STUDENT')->orderBy('updated_at' ,'desc')->paginate(18);
        return view('livewire.components.learnerlist', compact('users'));
    }
}

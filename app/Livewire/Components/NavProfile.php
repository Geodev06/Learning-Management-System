<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NavProfile extends Component
{

    public function logout()
    {
        if (!Auth::check()) {
            return;
        }

        Auth::logout();
        session()->regenerate();
        $this->redirect('/');
    }
    public function render()
    {
        return view('livewire.components.nav-profile');
    }
}

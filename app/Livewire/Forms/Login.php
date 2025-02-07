<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Login extends Component
{


    public $email, $password;
    
    public function submit()
    {
        // Validate email and password
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        try {
            // Check if the user exists
            $user = User::where('email', $this->email)->first();
    
            if ($user && Hash::check($this->password, $user->password)) {
                // If the password matches, log the user in
                Auth::login($user);
    
                return redirect()->route('dashboard');  // Redirect to your desired route
                
            } else {
                // If user not found or password doesn't match
                session()->flash('error', $this->lang['invalid_cred']);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            session()->flash('error', $th->getMessage());
        }
    }
    

    public function render()
    {
        return view('livewire.forms.login');
    }
}

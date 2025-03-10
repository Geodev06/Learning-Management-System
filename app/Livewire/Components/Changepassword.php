<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
class Changepassword extends Component
{

    public $old_password;
    public $password;
    public $password_confirmation;

    // Validation rules
    protected $rules = [
        'old_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ];

    // Validation messages
    protected $messages = [
        'password.confirmed' => 'The new password confirmation does not match.',
        'old_password.required' => 'Please enter your current password.',
        'password.required' => 'Please enter a new password.',
        'password.min' => 'The new password must be at least 8 characters long.',
    ];

    public function submit()
    {
        // Validate the inputs
        $this->validate();

        // Check if the old password matches the current password in the database
        if (!Hash::check($this->old_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['The provided current password is incorrect.'],
            ]);
        }

        // Update the password if the old password is correct
        auth()->user()->update([
            'password' => Hash::make($this->password),
        ]);


        // Success message or redirection
        $this->dispatch('success', [
            'title' => 'Success',
            'message' => $this->lang['changes_saved'],
            'status' => 'success',

        ]);

        $this->reset();

    }
    public function render()
    {
        return view('livewire.components.changepassword');
    }
}

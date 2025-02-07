<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Registration extends Component
{

    public $first_name, $middle_name, $last_name, $email, $password, $password_confirmation;

    public function submit()
    {

        $user = new User();
        
        $this->validate(User::$rules);

        try {
            DB::beginTransaction();
            $user->first_name = $this->_encrypt($this->first_name);
            $user->middle_name = $this->_encrypt($this->middle_name);
            $user->last_name = $this->_encrypt($this->last_name);
            $user->email = $this->email;
            $user->password = Hash::make($this->password);
            $user->save();

            session()->flash('success', $this->lang['register_success']);

            DB::commit();
            $this->reset();

            
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.forms.registration');
    }
}

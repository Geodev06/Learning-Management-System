<?php

namespace App\Livewire\Components;

use App\Models\ParamOrganization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Personalinformation extends Component
{

    public $first_name, $middle_name, $last_name, $gender, $org_code;

    public function mount()
    {
        $this->first_name = base64_decode(Auth::user()->first_name);
        $this->middle_name = base64_decode(Auth::user()->middle_name);
        $this->last_name = base64_decode(Auth::user()->last_name);
        $this->gender = Auth::user()->gender;

        if(Auth::user()->org_code != '' OR Auth::user()->org_code != null) {
            $this->org_code = Auth::user()->org_code;
        }

    }

    public function submit()
    {

        $user = User::find(Auth::user()->id);

        $this->validate([
            'first_name'    => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'middle_name'   => 'nullable|string|regex:/^[a-zA-Z\s]*$/|max:255', // Optional field
            'last_name'     => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'gender' => 'required',
            'org_code' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $user->first_name = $this->_encrypt($this->first_name);
            $user->middle_name = $this->_encrypt($this->middle_name);
            $user->last_name = $this->_encrypt($this->last_name);
            $user->gender = $this->gender;
            $user->org_code = $this->org_code;
            $user->save();

            $this->dispatch('success', [
                'title' => 'Success',
                'message' => $this->lang['changes_saved'],
                'status' => 'success',
    
            ]);
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }

    public function render()
    {
        $orgs = ParamOrganization::all(['org_code','name']);
        return view('livewire.components.personalinformation', compact('orgs'));
    }
}

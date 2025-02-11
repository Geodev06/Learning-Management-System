<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Livewire\WithFileUploads;

class AttachmentForm extends Component
{
    use WithFileUploads;

    public function submit() 
    {
        
    }
    
    public function render()
    {
        return view('livewire.forms.attachment-form');
    }
}

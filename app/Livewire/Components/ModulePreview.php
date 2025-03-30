<?php

namespace App\Livewire\Components;

use App\Models\Assessment;
use App\Models\Module;
use App\Models\ModuleLesson;
use App\Models\StudentModule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ModulePreview extends Component
{

    public $id;
    public $is_added = false;


    public function mount($id)
    {
        $this->id = $id;

        $added = StudentModule::where([
            'created_by' => Auth::user()->id,
            'module_id' => $id
        ])->first();


        if ($added) {
            $this->is_added = true;
        }
    }

    public function submit()
    {
        try {

            $this->validate([
                'id' => 'required'
            ]);

            DB::beginTransaction();

            $student_module = new StudentModule();

            $student_module->module_id = $this->id;
            $student_module->created_by = Auth::user()->id;
            $student_module->save();

            $name = base64_decode(Auth::user()->first_name) . ' ' . base64_decode(Auth::user()->last_name);

            $notification_data = [
                'type' => 'notification',
                'title' => 'Enrollee',
                'icon' => 'fas fa-bell',
                'seen_flag' => 0,
                'link' => '',
                'message' =>  ucfirst($name) . ' has successfully enrolled in your course. [ ' . Module::find($this->id)->title . ' ]',
                'receiver_id' => Module::find($this->id)->created_by,
                'created_by' => Auth::user()->id
            ];

            $this->notify_users($notification_data);

            $this->dispatch('success', [
                'title' => 'Success',
                'message' => 'Successfully Enrolled.',
                'status' => 'success'
            ]);
            $this->is_added = true;

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }
    public function render()
    {
        $module = Module::find($this->id);
        $module_lessons = ModuleLesson::where('module_id', $this->id)->get();

        $author = User::find($module->created_by);

        $module->author = base64_decode($author->first_name) . ' ' . base64_decode($author->last_name);

        
        $takers = StudentModule::where('module_id', $this->id)->count();
        $avg_score = Assessment::where('module_id', $this->id)->avg('grade');

        $totalAssessments = Assessment::where('module_id', $this->id)->count();
        if ($totalAssessments > 0) {
            $passing = (Assessment::where('module_id', $this->id)->where('grade', '>=', 75)->count() / $totalAssessments) * 100;
        } else {
            $passing = 0; // or any other default value you want to set when there are no assessments
        }


        return view('livewire.components.module-preview', compact('module', 'module_lessons','passing','takers' ,'avg_score'));
    }
}

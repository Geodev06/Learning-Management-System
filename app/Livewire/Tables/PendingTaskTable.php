<?php

namespace App\Livewire\Tables;

use App\Models\Assessment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PendingTaskTable extends Component
{
    use WithPagination;


    public function render()
    {
        if (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'TEACHER') {

            $assessments = Assessment::where([
                'checker_id' => Auth::user()->id,
                'checked_flag' => 'N'
            ])->orderBy('created_at','desc')->paginate(10);

            foreach ($assessments as $item) {
                $creator = User::find($item->created_by);
                $item->creator = base64_decode($creator->first_name) . ' ' . base64_decode($creator->last_name);
            }
        }

        if (Auth::user()->role == 'STUDENT') {

            $assessments = Assessment::where([
                'created_by' => Auth::user()->id,
            ])->orderBy('created_at','desc')->paginate(10);

            foreach ($assessments as $item) {
                $creator = User::find($item->created_by);
                $item->creator = base64_decode($creator->first_name) . ' ' . base64_decode($creator->last_name);
            }
        }

        return view('livewire.tables.pending-task-table', compact('assessments'));
    }
}

<?php

namespace App\Livewire\Components;

use App\Models\Assessment;
use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Leaderboard extends Component
{
    public function render()
    {

        if (Auth::user()->role == 'TEACHER') {
            $module_ids = Module::where('created_by', Auth::user()->id)
                ->pluck('id'); // Get only the 'id' column as a collection, no need for `toArray()` 
        }

        if (Auth::user()->role == 'ADMIN') {
            $module_ids = Module::pluck('id'); // Get only the 'id' column as a collection, no need for `toArray()` 
        }

        if ($module_ids->isNotEmpty()) { // Check if the collection is not empty
            $tops = Assessment::selectRaw('SUM(points) as points, created_by')
                ->whereIn('module_id', $module_ids)
                ->groupBy('created_by')
                ->orderByDesc('points')
                ->limit(10)
                ->get();

            foreach ($tops as $item) {
                $user = User::find($item->created_by);
                $item->full_name =  base64_decode($user->first_name) . ' ' . base64_decode($user->middle_name) . ' ' . base64_decode($user->last_name);
            }
            
        } else {
            $tops = collect(); // Return an empty collection instead of an array for consistency
        }

        return view('livewire.components.leaderboard', compact('tops'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChartController extends Controller
{
    public function get_avg_score_per_modules()
    {
        try {
            $my_modules = Module::where('created_by', Auth::user()->id)->get();

            foreach ($my_modules as $module) {
                $module->avg_score = Assessment::where('module_id', $module->id)
                    ->where('checked_flag', 'Y')
                    ->avg('grade');
            }

            return response()->json($my_modules, 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json('Internal Server Error', 500);
        }
    }
}

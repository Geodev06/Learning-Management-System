<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function get_avg_score_per_modality()
    {
        try {
            $res = DB::select("
            SELECT
                AVG(CASE WHEN M.a_flag = 1 THEN A.grade END) AS auditory,
                AVG(CASE WHEN M.v_flag = 1 THEN A.grade END) AS visual,
                AVG(CASE WHEN M.K_flag = 1 THEN A.grade END) AS kinesthetic,
                AVG(CASE WHEN M.r_flag = 1 THEN A.grade END) AS reading_writing
            FROM
                assessments A
            JOIN
                modules M ON M.id = A.module_id
            ");

            return response()->json($res, 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}

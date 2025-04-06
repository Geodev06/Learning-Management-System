<?php

namespace App\Http\Controllers;

use App\Models\ParamAward;
use App\Models\UserAward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AwardController extends Controller
{
    public function get_award_list()
    {
        $data = DB::select("SELECT id as value, CONCAT(title, ' - ', description) as text FROM param_awards");
        return response()->json($data, 200);
    }

    public function commend(Request $request)
    {
        try {
            $request->validate([
                'award' => 'required',
                'date_acquired' => 'required',
            ]);

            DB::beginTransaction();


            $ok = UserAward::create([
                'award_id' => $request->award,
                'user_id'   => $request->user_id,
                'date_acquired' => $request->date_acquired,
                'created_by' => Auth::user()->id,
            ]);
            DB::commit();

            if ($ok) {
                return response()->json('Award has been given', 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::error($th->getMessage());
            return response()->json($th->getMessage(), 500);
        }
    }
}

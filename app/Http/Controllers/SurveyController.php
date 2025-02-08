<?php

namespace App\Http\Controllers;

use App\Models\ModalityStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function survey()
    {
        return view('pages.survey');
    }

    public function get_pre_assessment()
    {
        $data = ModalityStat::where('created_by', Auth::user()->id)->first();
        return response()->json($data, 200);
    }
}

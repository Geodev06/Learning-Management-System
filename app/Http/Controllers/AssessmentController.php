<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function module_assessment($module_id, $lesson_id)
    {
        return view('pages.module_assessment', compact('module_id','lesson_id'));
    }
}

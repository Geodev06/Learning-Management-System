<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Module;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function module_assessment($module_id, $lesson_id, $type)
    {
        return view('pages.module_assessment', compact('module_id', 'lesson_id', 'type'));
    }

    public function assessment($module_id, $lesson_id, $assessment_id)
    {
        $module = Module::find(decrypt($module_id));

        return view('pages.assessment', compact('module_id', 'lesson_id', 'assessment_id', 'module'));
    }

    public function view_assessment_result($assessment_id)
    {
        $module = Module::find(Assessment::find(decrypt($assessment_id))->module_id);

        return view('pages.view_assessment_result', compact('assessment_id', 'module'));
    }

    public function assessments()
    {
        return view('pages.assessments_module');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\ModuleLesson;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard');
    }

    public function modules()
    {
        return view('pages.modules');
    }

    public function module_lessons($module_id)
    {
        $module_id = base64_decode($module_id);
        $module = Module::find($module_id);
        $lessons = ModuleLesson::where('module_id', $module_id)->get();
        return view('pages.module_lessons', compact('lessons', 'module'));
    }

    public function manage_lessons($module_id, $lesson_id)
    {
        $module_id = base64_decode($module_id);
        $lesson_id = base64_decode($lesson_id);

        $module = Module::find($module_id);
        $lesson = ModuleLesson::find($lesson_id);


        return view('pages.lesson', compact('module','lesson'));
        
    }
}

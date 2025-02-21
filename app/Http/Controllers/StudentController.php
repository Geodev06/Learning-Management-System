<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\ModuleLesson;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function learn()
    {
        return view('pages.learn');
    }

    public function my_modules()
    {
        return view('pages.my_modules');
    }

    public function module_preview($module_id)
    {
        $module_id = decrypt($module_id);
        $module = Module::find($module_id);
        return view('pages.module_preview', compact('module'));
    }

    public function learn_module($module_id)
    {
        $module_id = decrypt($module_id);
        $module = Module::find($module_id);

        $lessons = ModuleLesson::where('module_id', $module_id)->where('open_flag', 'Y')->get();

        return view('pages.learn_module', compact('module', 'lessons'));
    }

    public function learn_lesson($module_id, $lesson_id)
    {
        $module_id = decrypt($module_id);
        $lesson_id = decrypt($lesson_id);

        $module = Module::find($module_id);

        $lesson = ModuleLesson::find($lesson_id);

        return view('pages.learn_lesson', compact('module', 'lesson'));
    }
}

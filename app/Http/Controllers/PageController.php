<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Assessment;
use App\Models\LessonQuestion;
use App\Models\Module;
use App\Models\ModuleLesson;
use App\Models\ParamOrganization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function dashboard()
    {
        $total_user_points = Assessment::where('created_by', Auth::user()->id)->sum('points');

        $data = [];

        if (Auth::user()->role == 'ADMIN') {
            $data['no_of_users'] = User::where('role', '!=', 'ADMIN')->count();
            $data['no_of_modules'] = Module::count();
            $data['no_of_activities'] = LessonQuestion::distinct('module_id', 'lesson_id')->count();
            $data['no_of_student_submission_today'] = Assessment::whereDate('created_at', now()->toDateString())->count();
        }

        if (Auth::user()->role == 'TEACHER') {
            $data['no_of_modules'] = Module::where('created_by', Auth::user()->id)->count();
        }

        return view('pages.dashboard', [
            'total_user_points' => $total_user_points,
            'data' => $data
        ]);
    }

    public function modules()
    {
        return view('pages.modules');
    }

    public function module_lessons($module_id)
    {
        $module_id = base64_decode($module_id);
        $module = Module::with('access')->find($module_id);
        $lessons = ModuleLesson::where('module_id', $module_id)->get();
        $orgs = ParamOrganization::all();

        $saved_orgs = array_column($module->access->toArray(), 'org_code');
        return view('pages.module_lessons', compact('lessons', 'module', 'orgs', 'saved_orgs'));
    }

    public function manage_lessons($module_id, $lesson_id)
    {
        $module_id = base64_decode($module_id);
        $lesson_id = base64_decode($lesson_id);
        $module = Module::find($module_id);
        $lesson = ModuleLesson::find($lesson_id);
        return view('pages.lesson', compact('module', 'lesson'));
    }

    public function manage_activities($module_id, $lesson_id, $type)
    {
        $module_id = base64_decode($module_id);
        $lesson_id = base64_decode($lesson_id);
        $type = decrypt($type);
        $module = Module::find($module_id);
        $lesson = ModuleLesson::find($lesson_id);

        switch ($type) {
            case 'MC':
                $type = 'Multiple Choice';
                break;
            case 'I':
                $type = 'Identification';
                break;
            case 'E':
                $type = 'Essay';
                break;
            case 'HO':
                $type = 'Hands-On';
                break;

            default:
                # code...
                break;
        }

        return view('pages.manage_activities', compact('module', 'lesson', 'type'));
    }
}

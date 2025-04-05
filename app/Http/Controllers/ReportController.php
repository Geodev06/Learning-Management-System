<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Module;
use App\Models\ModuleLesson;
use App\Models\ParamOrganization;
use App\Models\ReportModel;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function index()
    {
        return view('pages.reports');
    }

    public function report_list()
    {
        $data = [
            [
                'text' => 'Report on Student Modality by Organization',
                'id' => 'REPORT_STUDENT_MODALITY',
            ],
            [
                'text' => 'Users MasterList',
                'id' => 'REPORT_USER_MASTER_LIST',
            ],
            [
                'text' => 'Submissions per Module',
                'id' => 'REPORT_STUDENT_SUBMISION_RESULT_PER_MODULE',
            ],
        ];

        return response()->json($data, 200);
    }

    public function generate(Request $request)
    {
        $report_code = $request->report_code;

        $dompdf = new Dompdf();
        $model = new ReportModel();

        switch ($report_code) {
            case 'REPORT_STUDENT_MODALITY':
                // Validate before accessing org_code
                $request->validate([
                    'org_code' => 'required' // Fixed 'Required' to lowercase 'required'
                ]);

                $data = $model->student_modality($request->org_code);
                $html = view('reports.student_modality', compact('data'))->render();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $pdfContent = $dompdf->output();
                break;

            case 'REPORT_USER_MASTER_LIST':
                // You should load actual data if necessary, not just an empty array
                $admin = User::where('role', 'ADMIN')->count();
                $teacher = User::where('role', 'TEACHER')->count();
                $student = User::where('role', 'STUDENT')->count();

                $data = User::all(); // Assuming this method exists
                $html = view('reports.user_master_list', compact('data', 'admin', 'teacher', 'student'))->render();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'landscape');
                $dompdf->render();
                $pdfContent = $dompdf->output();
                break;
            case 'REPORT_STUDENT_SUBMISION_RESULT_PER_MODULE':
                $request->validate([
                    'module' => 'required',
                    'student' => 'required',
                ]);
                $student = User::find($request->student);
                $name = base64_decode($student->first_name) . ' ' . base64_decode($student->middle_name) . ' ' . base64_decode($student->last_name);
                $course = ParamOrganization::where('org_code', $student->org_code)->first()->name;

                $module = Module::find($request->module);

                $module_lessons = ModuleLesson::where('module_id', $module->id)->get(['id','lesson_no']);

                foreach ($module_lessons as $lesson) {
                    $assessment_mc = Assessment::where(
                        [
                            'module_id' => $module->id,
                            'lesson_id' => $lesson->id,
                            'type'      => 'MC',
                            'created_by'=> $student->id
                        ]
                    )->first();

                    $assessment_essay = Assessment::where(
                        [
                            'module_id' => $module->id,
                            'lesson_id' => $lesson->id,
                            'type'      => 'E',
                            'created_by'=> $student->id
                        ]
                    )->first();

                    $assessment_identification = Assessment::where(
                        [
                            'module_id' => $module->id,
                            'lesson_id' => $lesson->id,
                            'type'      => 'I',
                            'created_by'=> $student->id
                        ]
                    )->first();

                    $assessment_ho = Assessment::where(
                        [
                            'module_id' => $module->id,
                            'lesson_id' => $lesson->id,
                            'type'      => 'HO',
                            'created_by'=> $student->id
                        ]
                    )->first();

                    $lesson->detail = [
                        'Multiple Choice'  => [
                            'grade'               => $assessment_mc ? $assessment_mc->grade : 'N/A',
                            'points'              => $assessment_mc ? $assessment_mc->points : 'N/A',
                            'total_points'        => $assessment_mc ? $assessment_mc->total_points : 'N/A',
                            'date'                => $assessment_mc && $assessment_mc->created_at ? $assessment_mc->created_at->format('M d, Y') : 'N/A',
                        ],
                        'Essay'  => [
                            'grade'               => $assessment_essay ? $assessment_essay->grade : 'N/A',
                            'points'              => $assessment_essay ? $assessment_essay->points : 'N/A',
                            'total_points'        => $assessment_essay ? $assessment_essay->total_points : 'N/A',
                            'date'                => $assessment_essay && $assessment_essay->created_at ? $assessment_essay->created_at->format('M d, Y') : 'N/A',
                        ],
                        'Identification'  => [
                            'grade'               => $assessment_identification ? $assessment_identification->grade : 'N/A',
                            'points'              => $assessment_identification ? $assessment_identification->points : 'N/A',
                            'total_points'        => $assessment_identification ? $assessment_identification->total_points : 'N/A',
                            'date'                => $assessment_identification && $assessment_identification->created_at ? $assessment_identification->created_at->format('M d, Y') : 'N/A',
                        ],
                        'Hands-on'  => [
                            'grade'               => $assessment_ho ? $assessment_ho->grade : 'N/A',
                            'points'              => $assessment_ho ? $assessment_ho->points : 'N/A',
                            'total_points'        => $assessment_ho ? $assessment_ho->total_points : 'N/A',
                            'date'                => $assessment_ho && $assessment_ho->created_at ? $assessment_ho->created_at->format('M d, Y') : 'N/A',
                        ],
                    ];
                    
                }
                
                $html = view('reports.student_submission_result_per_module', compact('name', 'course', 'module','module_lessons'))->render();
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $pdfContent = $dompdf->output();
                break;

            default:
                return response()->json(['message' => 'Report Not Found!'], 404);
                break;
        }

        // Return the PDF content as JSON response
        return response()->json([
            'pdf_content' => base64_encode($pdfContent)
        ]);
    }

    public function filter(Request $request)
    {
        $filter_view = '';

        $report_code = $request->report_code;

        switch ($report_code) {
            case 'REPORT_STUDENT_MODALITY':

                $filter_view = view('report_filter.student_modality', compact('report_code'))->render();

                break;
            case 'REPORT_USER_MASTER_LIST':

                $filter_view = view('report_filter.user_master_list', compact('report_code'))->render();

                break;
            case 'REPORT_STUDENT_SUBMISION_RESULT_PER_MODULE':

                $filter_view = view('report_filter.student_submission_result_per_module', compact('report_code'))->render();

                break;

            default:

                return response()->json('Report Not Found!', 404);

                break;
        }

        return response()->json($filter_view, 200);
    }

    public function student_list(Request $request)
    {
        $model = new ReportModel();
        $data = $model->get_students($request->module_id);
        return response()->json($data);
    }

    public function module_list()
    {
        $model = new ReportModel();
        $data = $model->get_modules();
        return response()->json($data);
    }
}

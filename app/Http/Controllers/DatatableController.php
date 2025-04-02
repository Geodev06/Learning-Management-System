<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{


    public function student_performance_table(Request $request)
    {
        try {

            $model = new BaseModel();

            if ($request->ajax()) {

                return DataTables::of($model->construct_performance_table())
                    ->addColumn('name', function ($row) {
                        return $row->first_name . ' ' . $row->last_name;
                    })
                    ->addColumn('auditory', function ($row) {
                        return '
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                    <p class="text-success">' . $row->auditory . '%</p>
                                </div>
                                <div class="progress progress-md">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: ' . $row->auditory . '%" aria-valuenow="' . $row->auditory . '" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        ';
                    })
                    ->addColumn('visual', function ($row) {
                        return '
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                    <p class="text-success">' . $row->visual . '%</p>
                                </div>
                                <div class="progress progress-md">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: ' . $row->visual . '%" aria-valuenow="' . $row->visual . '" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        ';
                    })
                    ->addColumn('kinesthetic', function ($row) {
                        return '
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                    <p class="text-success">' . $row->kinesthetic . '%</p>
                                </div>
                                <div class="progress progress-md">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: ' . $row->kinesthetic . '%" aria-valuenow="' . $row->kinesthetic . '" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        ';
                    })
                    ->addColumn('reading_writing', function ($row) {
                        return '
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                    <p class="text-success">' . $row->reading_writing . '%</p>
                                </div>
                                <div class="progress progress-md">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: ' . $row->reading_writing . '%" aria-valuenow="' . $row->reading_writing . '" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        ';
                    })
                    ->rawColumns(['auditory', 'name', 'kinesthetic', 'reading_writing', 'visual'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function users_table(Request $request)
    {
        try {

            $model = new BaseModel();

            if ($request->ajax()) {

                return DataTables::of($model->contruct_users_table())
                    ->addColumn('status', function ($row) {

                        $span_html = "
                            <div class='text-center'>
                                <span class='badge badge-" . ($row->status == 'Active' ? 'success' : 'danger') . "'>" . $row->status . "</span>
                            </div>
                        ";
                        return $span_html;
                    })
                    ->addColumn('action', function ($row) {
                        return '
                            <div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="' . route('profile_preview', encrypt($row->id)) . '" class="mx-2 btn btn-primary btn-sm btn-rounded btn-fw">View</a>
                                    <button onclick=" show_modal(' . $row->id . ') "  class="btn btn-danger btn-sm btn-rounded btn-fw">Edit</button>

                                </div>
                              
                            </div>
                        ';
                    })
                    ->rawColumns(['first_name', 'middle_name', 'last_name', 'status', 'last_login', 'action'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function submission_table_per_lesson($module_id, $lesson_id, Request $request) 
    {
        try {

            $model = new BaseModel();

            if ($request->ajax()) {

                return DataTables::of($model->contruct_submission_table_per_lesson_table($module_id, $lesson_id))
                    ->rawColumns(['fullname', 'mark', 'grade', 'status', 'created_at', 'type','total_points'])
                    ->make(true);
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}

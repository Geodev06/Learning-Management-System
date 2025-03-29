<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{


    public function student_performance_table(Request $request)
    {
        try {
            // Query to fetch performance data along with scores for different flags (auditory, visual, kinesthetic, reading_writing)

            $query = DB::select(
                "
                SELECT
                    A.created_by, A.module_id,
                    FROM_BASE64(B.first_name) first_name, FROM_BASE64(B.last_name) last_name,
                    C.score auditory,
                    D.score visual,
                    E.score kinesthetic,
                    F.score reading_writing
                    FROM assessments A
                    JOIN users B ON B.id = A.created_by
                    LEFT JOIN (
                        SELECT AVG(A.grade) score, A.created_by
                        FROM assessments A
                        JOIN users B ON B.id = A.created_by
                        JOIN modules C ON C.id = A.module_id
                        WHERE C.a_flag = 1
                        GROUP BY A.created_by
                    ) C ON C.created_by = A.created_by
                    
                    LEFT JOIN (
                        SELECT AVG(A.grade) score, A.created_by
                        FROM assessments A
                        JOIN users B ON B.id = A.created_by
                        JOIN modules C ON C.id = A.module_id
                        WHERE C.v_flag = 1
                        GROUP BY A.created_by
                    ) D ON D.created_by = A.created_by
                    
                    LEFT JOIN (
                        SELECT AVG(A.grade) score, A.created_by
                        FROM assessments A
                        JOIN users B ON B.id = A.created_by
                        JOIN modules C ON C.id = A.module_id
                        WHERE C.K_flag = 1
                        GROUP BY A.created_by
                    ) E ON E.created_by = A.created_by
                    
                    LEFT JOIN (
                        SELECT AVG(A.grade) score, A.created_by
                        FROM assessments A
                        JOIN users B ON B.id = A.created_by
                        JOIN modules C ON C.id = A.module_id
                        WHERE C.r_flag = 1
                        GROUP BY A.created_by
                    ) F ON F.created_by = A.created_by
                    WHERE 1 = 1
                    AND B.role = 'STUDENT'
                "
            );

            if ($request->ajax()) {
                return DataTables::of($query)
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
}

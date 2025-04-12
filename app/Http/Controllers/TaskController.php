<?php

namespace App\Http\Controllers;

use App\Models\ParamTask;
use App\Models\TaskParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class TaskController extends Controller
{
    public function index()
    {
        return view('pages.assignment_and_projects');
    }

    public function load_students(Request $request)
    {
        $org = $request->value;

        // Base query
        $query = "
            SELECT 
                CONCAT_WS('', FROM_BASE64(first_name), FROM_BASE64(middle_name), FROM_BASE64(last_name)) AS text, 
                id AS value 
            FROM users 
            WHERE 1=1 AND role = 'STUDENT' AND active_flag = 'Y'
        ";

        // Add conditionally org_code filter
        $params = [];

        if ($org !== 'ALL') {
            $query .= " AND org_code = ?";
            $params[] = $org;
        }

        // Run query with or without parameters
        $data = DB::select($query, $params);

        return response()->json($data, 200);
    }

    public function get_saved_participants(Request $request)
    {
        $task_id = !is_null($request->value) ? $request->value : null;
        $query = [];
        if (!is_null($task_id)) {
            $query = DB::select("
            SELECT
             CONCAT_WS(' ', FROM_BASE64(B.first_name),  FROM_BASE64(B.middle_name),  FROM_BASE64(B.last_name)) text,
                 A.user_id as value
                 FROM task_participants A
                    JOIN users B ON B.id = A.user_id
             WHERE A.task_id = ?
         ", [$task_id]);
        }

        return response()->json($query, 200);
    }

    public function form($id = null)
    {
        $data = [];


        if ($id) {
            $id = decrypt($id);
            $data = ParamTask::find($id);
        }
        return view('pages.assignment_and_projects.form', compact('data'));
    }

    public function process_task(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:50',
            'instructions' => 'required|max:5000',
            'type' => 'required',
            'modality' => 'required',
            'submission_type' => 'required',
            'deadline' => 'required|date|after:now'
        ]);


        try {

            DB::beginTransaction();

            $post_flag = $request->post_flag;
            $record_id = isset($request->id) || $request->id != '' ? decrypt($request->id) : null;
            $respondents = !is_null($request->respondents) ? explode(',', $request->respondents) : null;
            if (is_null($record_id)) {

                $task = ParamTask::create([
                    'title' => $request->title,
                    'instructions' => $request->instructions,
                    'type' => $request->type,
                    'submission_type' => $request->submission_type,
                    'modality' => $request->modality,
                    'deadline'  => $request->deadline,
                    'posted_date'   => $post_flag == 'Y' ? now() : null,
                    'created_by'   => Auth::user()->id,
                    'posted_flag'   => $post_flag == 'Y' ? 'Y' : 'N'
                ]);

                if (!is_null($respondents)) {
                    if (sizeof($respondents) > 0) {
                        foreach ($respondents as $item) {
                            TaskParticipant::create([
                                'task_id' => $task->id,
                                'user_id' => $item,
                            ]);
                        }
                    }
                }
            } else {
                ParamTask::where('id', $record_id)->update([
                    'title' => $request->title,
                    'instructions' => $request->instructions,
                    'type' => $request->type,
                    'submission_type' => $request->submission_type,
                    'modality' => $request->modality,
                    'deadline'  => $request->deadline,
                    'posted_date'   => $post_flag == 'Y' ? now() : null,
                    'posted_flag'   => $post_flag == 'Y' ? 'Y' : 'N',
                    'created_by'   => Auth::user()->id
                ]);

                TaskParticipant::where('task_id', $record_id)->delete();

                if (!is_null($respondents)) {
                    if (sizeof($respondents) > 0) {
                        foreach ($respondents as $item) {
                            TaskParticipant::create([
                                'task_id' => $record_id,
                                'user_id' => $item,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status'  => 'success',
                'title' => 'Success',
                'msg' => 'Record has been saved.'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }
}

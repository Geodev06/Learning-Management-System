<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseModel extends Model
{
    use HasFactory;

    public function construct_performance_table()
    {
        try {
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

            return $query;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function contruct_users_table()
    {
        try {
            $query = DB::select(
                "
                    SELECT
                        A.id,
                        FROM_BASE64(A.first_name) first_name,
                        FROM_BASE64(A.middle_name) middle_name,
                        FROM_BASE64(A.last_name) last_name,
                        IF(A.active_flag = 'Y', 'Active','Inactive') status,
                      
                        A.role,
                        A.updated_at last_login,
                        A.org_code,
                        A.gender,
                        A.email
                        FROM users A
                        WHERE A.role != 'ADMIN'
                "
            );

            return $query;

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function contruct_submission_table_per_lesson_table($module_id, $lesson_id)
    {
        try {
            $query = DB::select(
                "
                SELECT 
                        A.total_points, A.no_of_items, A.grade, IF(A.mark = 'P', 'Passed' ,'Failed') mark, 
                        CASE
                            WHEN A.type = 'MC' THEN 'Multiple Choice'
                            WHEN A.type = 'HO' THEN 'Hands On'
                            WHEN A.type = 'I' THEN  'Identification'
                            WHEN A.type = 'E' THEN  'Essay'

                        END as type,
                        IF(A.checked_flag = 'Y','Done','For Checking') status,
                        CONCAT_WS(' ', FROM_BASE64(B.first_name), FROM_BASE64(B.middle_name), FROM_BASE64(B.last_name)) fullname,
                        DATE_FORMAT(A.created_at, '%M %d, %Y %h:%i %p') created_at
                    FROM assessments A
                        JOIN users B ON B.id = A.created_by
                        WHERE A.module_id = ?
                              AND A.lesson_id = ?
                ",[$module_id, $lesson_id]
            );

            return $query;

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}

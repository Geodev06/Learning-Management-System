<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class ReportModel extends Model
{
    use HasFactory;

    public function student_modality($org_code)
    {
        try {
            $where = "";
            $params = [];

            if ($org_code == 'ALL') {
                $where = "AND A.role = 'STUDENT'";
            } else {
                $where = "AND A.org_code = ? AND A.role = 'STUDENT'";
                $params[] = $org_code;  // Add the org_code to the parameters array
            }

            return DB::select(
                "
                SELECT 
                    CONCAT_WS(' ', FROM_BASE64(A.first_name),  FROM_BASE64(A.middle_name),  FROM_BASE64(A.last_name)) name,
                    A.email,
                    CASE
                        WHEN A.org_code = 'BS_IT' THEN 'Information Technology'
                        WHEN A.org_code = 'BS_CS' THEN 'Computer Science'
                        ELSE 'Not set'
                    END as org,
                    CASE
                        WHEN A.gender = 'F' THEN 'Female'
                        WHEN A.gender = 'M' THEN 'Male'
                        ELSE 'Not set'
                    END as gender,
                    CASE
                        WHEN A.learning_modality = 'R' THEN 'Reading and Writing'
                        WHEN A.learning_modality = 'A' THEN 'Auditory'
                        WHEN A.learning_modality = 'V' THEN 'Visual'
                        WHEN A.learning_modality = 'K' THEN 'Kinesthetic'
                        ELSE 'Not set'
                    END as modality
                FROM users A
                WHERE 1 = 1 $where",
                $params  // Pass the parameters array to the query
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function get_students($module_id)
    {
        try {
            return DB::select(
                "
                SELECT 
                DISTINCT
                A.created_by value,
                CONCAT_WS(' ', FROM_BASE64(B.first_name),  FROM_BASE64(B.middle_name),  FROM_BASE64(B.last_name)) text
                FROM student_modules A 
                JOIN users B ON B.id = A.created_by
                WHERE A.module_id = ? AND B.org_code IS NOT NULL",
                [$module_id]
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function get_modules()
    {
        try {
            return DB::select(
                "
                SELECT 
                    A.title as text,
                    A.id as value
                FROM modules A"
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}

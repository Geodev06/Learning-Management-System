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
}

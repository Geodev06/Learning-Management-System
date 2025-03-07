<?php

namespace App\Livewire\Tables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class AssessmentTable extends Component
{
    use WithPagination;

    public $search_field = '';

    public $page;

    public $per_page;

    public function per_page($per_page)
    {
        $this->per_page = $per_page;
    }


    public function gotoPage($page, $pageName = 'page')
    {
        $this->page = $page;
        $this->setPage($page, $pageName);
    }

    public function navigate($id)
    {
        $this->redirect(route('view_assessment_result', [
            'assessment_id' => encrypt($id)
        ]));
    }

    public function render()
    {
        $user = Auth::user();
        $search = strtolower($this->search_field);

        // Initial query
        $query = "
            SELECT DATE_FORMAT(A.created_at,'%M %d, %Y') created_at, A.checker_id, A.created_by,
            A.id,
            CASE 
                WHEN A.type = 'MC' THEN 'Multiple Choice'
                WHEN A.type = 'I' THEN 'Identification'
                WHEN A.type = 'E' THEN 'Essay'
                WHEN A.type = 'HO' THEN 'HO'
            END AS type, A.grade, IF(A.checked_flag = 'Y','Finished','Pending') checked_flag,
              B.first_name, B.last_name
            FROM assessments A
            JOIN users B ON B.id = A.created_by
            WHERE 1 = 1
        ";

        $bindings = [];

        if ($user->role === 'TEACHER') {
            $query .= " AND A.checker_id = ?";
            $bindings[] = $user->id;
        } elseif ($user->role !== 'ADMIN') {
            // Return empty view if not authorized
            return view('livewire.tables.assessmenttable', ['assessments' => collect()]);
        }

        // Fetch raw data
        $results = DB::select($query, $bindings);

        // Process and filter
        $assessments = collect($results)->map(function ($item) {
            $item->first_name = base64_decode($item->first_name ?? '');
            $item->last_name = base64_decode($item->last_name ?? '');
            return $item;
        });

        if (!empty($search)) {
            $assessments = $assessments->filter(function ($item) use ($search) {
                return str_contains(strtolower($item->first_name), $search) ||
                    str_contains(strtolower($item->last_name), $search) ||
                    str_contains(strtolower($item->created_at), $search) ||
                    str_contains(strtolower($item->type), $search) ||
                    str_contains(strtolower($item->grade), $search);
            });
        }

        // Manual Pagination
        $currentPage = $this->page ?? 1;
        $perPage = $this->per_page ?? 10;

        if ($perPage === 'ALL') {
            // Show all records — no pagination
            $paginatedAssessments = new \Illuminate\Pagination\LengthAwarePaginator(
                $assessments,
                $assessments->count(),
                $assessments->count(), // Set perPage to total count
                1, // Force page 1 (since there’s only 1 page)
                ['path' => request()->url(), 'query' => []]
            );
        } else {
            // Regular paginated view
            $paginatedAssessments = new \Illuminate\Pagination\LengthAwarePaginator(
                $assessments->forPage($currentPage, $perPage),
                $assessments->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => []]
            );
        }


        return view('livewire.tables.assessmenttable', [
            'assessments' => $paginatedAssessments
        ]);
    }
}

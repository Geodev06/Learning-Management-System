<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'active_flag',
        'org_code',
        'profile',
        'login_attempt',
        'reference_no',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Validation rules
    public static $rules = [
        'first_name'    => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'middle_name'   => 'nullable|string|regex:/^[a-zA-Z\s]*$/|max:255', // Optional field
        'last_name'     => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'email' => [
            'required',
            'email',
            'unique:users,email',
            'max:255',
            'regex:/^[a-zA-Z0-9._%+-]+@(lspu.edu.ph)$/',
        ],
        'password'      => 'required|string|min:8|confirmed', // Password must be at least 8 characters
    ];


    public function assessmentSummary($modality)
    {
        // Define the modality column based on the parameter
        $modalityColumn = null;

        switch ($modality) {
            case 'kinesthetic':
                $modalityColumn = 'A.k_flag';
                break;
            case 'auditory':
                $modalityColumn = 'A.a_flag'; // Assuming 'a_flag' for auditory
                break;
            case 'reading':
                $modalityColumn = 'A.r_flag'; // Assuming 'r_flag' for reading/writing
                break;
            case 'visual':
                $modalityColumn = 'A.v_flag'; // Assuming 'v_flag' for visual
                break;
            default:
                throw new \InvalidArgumentException('Invalid modality provided');
        }

        return $this->hasOne(
            DB::table('assessments as A')
                ->join('modules as B', 'B.id', '=', 'A.module_id')
                ->select('A.created_by', DB::raw('FORMAT(AVG(IFNULL(A.grade, 0)), 2) as score'))
                ->where('B.k_flag', 1) // filter modules if needed
                ->where($modalityColumn, 1) // dynamic modality filter
                ->groupBy('A.created_by'),
            'created_by'
        );
    }
}

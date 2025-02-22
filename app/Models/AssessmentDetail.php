<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'question',
        'correct_answer',
        'user_answer',
        'correct_flag',
        'points'
    ];
}

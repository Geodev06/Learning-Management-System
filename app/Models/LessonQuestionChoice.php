<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonQuestionChoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id','value','key'
    ];

 
}

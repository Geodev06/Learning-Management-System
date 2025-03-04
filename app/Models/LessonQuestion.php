<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id','lesson_id','question','correct','points','type'
    ];
}

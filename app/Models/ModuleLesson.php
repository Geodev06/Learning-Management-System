<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleLesson extends Model
{
    use HasFactory;
    protected $fillable  = [
        'module_id',
        'desc',
        'title',
        'lesson_no',
        'open_flag'
    ];
}

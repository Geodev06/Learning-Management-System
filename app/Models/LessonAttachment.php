<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonAttachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'lesson_id',
        'file_path',
        'file_type',
        'orig_file_name',
        'sys_file_name'
    ];
}

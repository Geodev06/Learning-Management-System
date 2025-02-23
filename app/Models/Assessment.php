<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'lesson_id',
        'created_by',
        'type',
        'mark',
        'grade',
        'points',
        'total_points',
        'no_of_items',
        'checked_flag',
        'checker_id'
    ];
}

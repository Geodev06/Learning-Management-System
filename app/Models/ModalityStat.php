<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalityStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'auditory_score',
        'visual_score',
        'kinesthetic_score',
        'reading_and_writing_score',
        'created_by'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'modality',
        'type',
        'deadline',
        'posted_date',
        'submission_type',
        'created_by',
        'posted_flag',
        'instructions'
    ];
}

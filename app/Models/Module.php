<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'bg_image'
    ];

    public function access()
    {
        return $this->hasMany(ModuleDetail::class, 'module_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}

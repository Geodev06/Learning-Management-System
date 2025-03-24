<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleDetail extends Model
{
    use HasFactory;

    protected $fillable = ['org_code','module_id'];

    public function name() 
    {
        return $this->hasOne(ParamOrganization::class, 'org_code');
    }
}

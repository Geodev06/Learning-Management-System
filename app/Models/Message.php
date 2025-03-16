<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiver_id',
        'created_by',
        'message',
        'seen_flag',
        'receiver_seen_flag',

    ];

    protected $casts = [
        'message' => 'encrypted'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

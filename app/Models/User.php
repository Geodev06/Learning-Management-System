<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'active_flag',
        'org_code',
        'profile',
        'login_attempt',
        'reference_no',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Validation rules
    public static $rules = [
        'first_name'    => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'middle_name'   => 'nullable|string|regex:/^[a-zA-Z\s]*$/|max:255', // Optional field
        'last_name'     => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'email' => [
            'required',
            'email',
            'unique:users,email',
            'max:255',
            'regex:/^[a-zA-Z0-9._%+-]+@(lspu.edu.ph)$/',
        ],
        'password'      => 'required|string|min:8|confirmed', // Password must be at least 8 characters
    ];
}

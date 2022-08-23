<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $guard = 'professional';

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'image',
        'title',
        'bio',
        'linkedin',
        'is_available',
        'is_admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'reason', 
        'status', // Mon - Sunday
        'start_datetime',
        'end_datetime',
    ];

    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

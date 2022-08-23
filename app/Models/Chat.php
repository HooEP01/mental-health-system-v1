<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'sender_role', 
        'sender_id', // Mon - Sunday
        'receiver_role',
        'receiver_id',
        'message',
    ];

    public function appointment(){
        return $this->belongsTo('App\Models\Appointment');
    }
}

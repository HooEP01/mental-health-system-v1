<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'appointment_id',
        'role',
        'visible',
    ];

    public function task(){
        return $this->belongsTo('App\Models\Task');
    }

    public function appointment(){
        return $this->belongsTo('App\Models\Appointment');
    }
}

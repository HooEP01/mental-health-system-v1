<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'periodical', // daily, weekly, biweekly, monthly 
        'day', // Mon - Sunday
        'start_datetime',
        'end_datetime',
    ];

    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

}

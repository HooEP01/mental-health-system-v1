<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'content_id',
        'title',
        'description',
    ];

    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function content(){
        return $this->belongsTo('App\Models\Content');
    }

}

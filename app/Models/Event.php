<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'type',
        'attendance_quantity',
        'amount',
        'image',
        'title',
        'description',
        'is_approve',
    ];

    public function professional(){
        return $this->belongsTo('App\Models\Professional');
    }
}

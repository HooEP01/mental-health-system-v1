<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_id',
        'answer',
    ];

    public function answer(){
        return $this->belongsTo('App\Models\Answer');
    }
}

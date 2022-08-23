<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'type', // short answer, paragraph, multiple choice, checkbox, file upload 
        'image',
        'audio',
        'subtitle',
        'description',
    ];

    public function content(){
        return $this->belongsTo('App\Models\Content');
    }
}

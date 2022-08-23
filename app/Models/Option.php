<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_detail_id',
        'description',
    ];

    public function contentDetail(){
        return $this->belongsTo('App\Models\ContentDetail');
    }
}

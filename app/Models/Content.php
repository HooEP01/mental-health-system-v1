<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'professional_id',
        'type', // Mon - Sunday
        'category',
        'image',
        'title',
        'summary',
        'is_approve',
    ];

    public function professional(){
        return $this->belongsTo('App\Models\Professional');
    }
}

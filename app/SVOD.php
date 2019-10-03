<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SVOD extends Model
{
    protected $fillable = [
        'title',
        'category',
        'content'
    ];
}

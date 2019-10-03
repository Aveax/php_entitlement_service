<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PPV extends Model
{
    protected $fillable = [
        'title',
        'content'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'ppv_user');
    }
}

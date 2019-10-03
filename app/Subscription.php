<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'subscription_category');
    }
}

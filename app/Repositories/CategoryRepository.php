<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository
{
    public function get($svod_id)
    {
        return Category::findOrFail($svod_id);
    }
}

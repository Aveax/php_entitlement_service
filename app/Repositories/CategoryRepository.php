<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function get($svod_id)
    {
        return Category::findOrFail($svod_id);
    }
}

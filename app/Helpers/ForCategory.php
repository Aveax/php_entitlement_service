<?php

namespace App\Helpers;

class ForCategory
{
    public function getCategoriesFromSubscription($sub)
    {
        $categories = [];
        foreach ($sub->category as $category) {
            array_push($categories, $category->name);
        }

        return $categories;
    }

    public function getCategoriesAsStringFromSubscription($sub)
    {
        return implode(" ",$this->getCategoriesFromSubscription($sub));
    }
}

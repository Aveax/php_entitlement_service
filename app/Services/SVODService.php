<?php

namespace App\Services;

use App\SVOD;
use App\Category;
use Illuminate\Http\Request;
use App\Helpers\Datetime;
use App\Helpers\Contains;

class SVODService
{
    public function getAllSVOD()
    {
        return SVOD::all();
    }

    public function getSVOD($id)
    {
        return SVOD::findOrFail($id);
    }

    public function createSVOD(Request $request)
    {
        $svod = new SVOD([
            'title' => $request->get('title'),
            'category'=> $request->get('category'),
            'content'=> $request->get('content')
        ]);
        $svod->save();
    }

    public function getCategoryName($svod)
    {
        $category = Category::findOrFail($svod->category);

        return $category->name;
    }

    public function getCategoriesNamesForSVODs($svods)
    {
        $categories = [];

        foreach ($svods as $svod) {
            $categories[$svod->id] = $this->getCategoryName($svod);
        }

        return $categories;
    }

    public function checkUserPermissionForSVOD($svod, $user)
    {
        if($user->subscription == null){
            return false;
        }

        $SubscriptionService = new SubscriptionService;

        $user_sub = $SubscriptionService->getSubscription($user->subscription);

        $categories = $SubscriptionService->getCategoriesForSubscription($user_sub);

        $actual = (new DateTime)->checkIfNotExpired($user->sub_end_date);

        $permission = (new Contains)->contains($categories, $this->getCategoryName($svod));

        if($actual && $permission){
            return true;
        }
        return false;
    }
}

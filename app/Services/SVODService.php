<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;
use App\Repositories\SVODRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Helpers\Datetime;
use App\Helpers\Contains;

class SVODService
{
    protected $SVODRepository;
    protected $CategoryRepository;

    public function __construct(SVODRepository $SVODRepository, CategoryRepository $CategoryRepository)
    {
        $this->SVODRepository = $SVODRepository;
        $this->CategoryRepository = $CategoryRepository;
    }

    public function getAllSVOD()
    {
        return $this->SVODRepository->all();
    }

    public function getSVOD($id)
    {
        return $this->SVODRepository->get($id);
    }

    public function createSVOD(Request $request)
    {
        $this->SVODRepository->create($request);
    }

    public function getCategoryName($svod)
    {
        $category = $this->CategoryRepository->get($svod->category);

        return $category->name;
    }

    public function getCategoriesNameForSVODs($svods)
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

        $SubscriptionService = new SubscriptionService(new SubscriptionRepository);

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

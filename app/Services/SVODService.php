<?php

namespace App\Services;

use App\Services\Interfaces\SVODServiceInterface;
use App\Services\Interfaces\SubscriptionServiceInterface;
use App\Repositories\Interfaces\SVODRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Helpers\Datetime;
use App\Helpers\Contains;

class SVODService implements SVODServiceInterface
{
    protected $SVODRepository;
    protected $CategoryRepository;

    protected $SubscriptionService;

    public function __construct(SVODRepositoryInterface $SVODRepository,
                                CategoryRepositoryInterface $CategoryRepository,
                                SubscriptionServiceInterface $SubscriptionService)
    {
        $this->SVODRepository = $SVODRepository;
        $this->CategoryRepository = $CategoryRepository;

        $this->SubscriptionService = $SubscriptionService;
    }

    public function getAllSVOD()
    {
        return $this->SVODRepository->all();
    }

    public function getSVOD($id)
    {
        return $this->SVODRepository->get($id);
    }

    public function createSVOD($request)
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

        $user_sub = $this->SubscriptionService->getSubscription($user->subscription);

        $categories = $this->SubscriptionService->getCategoriesForSubscription($user_sub);

        $actual = (new DateTime)->checkIfNotExpired($user->sub_end_date);

        $permission = (new Contains)->contains($categories, $this->getCategoryName($svod));

        if($actual && $permission){
            return true;
        }
        return false;
    }
}

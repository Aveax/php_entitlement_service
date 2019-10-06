<?php

namespace App\Services;

use App\Repositories\Interfaces\SubscriptionRepositoryInterface;
use App\Helpers\Contains;
use App\Helpers\DateTime;
use App\Helpers\ForCategory;

class SubscriptionService
{
    protected $SubscriptionRepository;

    public function __construct(SubscriptionRepositoryInterface $SubscriptionRepository)
    {
        $this->SubscriptionRepository = $SubscriptionRepository;
    }

    public function getAllSubscriptions()
    {
        return $this->SubscriptionRepository->all();
    }

    public function getSubscription($id)
    {
        return $this->SubscriptionRepository->get($id);
    }

    public function getCategoriesForSubscription($sub){
        return (new ForCategory)->getCategoriesFromSubscription($sub);
    }

    public function getCategoriesAsStringForSubscription($sub)
    {
        return (new ForCategory)->getCategoriesAsStringFromSubscription($sub);
    }

    public function getCategoriesForMultipleSubscriptions($subs)
    {
        $categories = [];

        foreach ($subs as $sub) {
            $categories[$sub->id] = $this->getCategoriesAsStringForSubscription($sub);
        }

        return $categories;
    }

    public function checkIfAllowedToBuySubscription($sub, $user)
    {
        $sub_categories = $this->getCategoriesForSubscription($sub);

        if($user->subscription == null){
            return false;
        }
        $user_subscription = $this->getSubscription($user->subscription);

        $user_actual_sub_categories = $this->getCategoriesForSubscription($user_subscription);

        $contains = (new Contains)->contains($user_actual_sub_categories, $sub_categories);

        $actual = (new DateTime)->checkIfNotExpired($user->sub_end_date);

        if($actual && $contains){
            return true;
        }
        return false;
    }
}

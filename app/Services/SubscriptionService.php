<?php

namespace App\Services;

use App\Helpers\Contains;
use App\Helpers\DateTime;
use App\Subscription;
use App\Helpers\ForCategory;

class SubscriptionService
{
    public function getAllSubscriptions()
    {
        return Subscription::all();
    }

    public function getSubscription($id)
    {
        return Subscription::findOrFail($id);
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

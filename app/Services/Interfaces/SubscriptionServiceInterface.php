<?php

namespace App\Services\Interfaces;

interface SubscriptionServiceInterface
{

    public function getAllSubscriptions();

    public function getSubscription($id);

    public function getCategoriesForSubscription($sub);

    public function getCategoriesAsStringForSubscription($sub);

    public function getCategoriesForMultipleSubscriptions($subs);

    public function checkIfAllowedToBuySubscription($sub, $user);
}

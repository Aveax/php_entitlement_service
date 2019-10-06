<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SubscriptionRepositoryInterface;
use App\Subscription;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    public function get($subscription_id)
    {
        return Subscription::findOrFail($subscription_id);
    }

    public function all()
    {
        return Subscription::all();
    }
}

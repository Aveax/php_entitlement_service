<?php

namespace App\Repositories;

use App\Subscription;

class SubscriptionRepository
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

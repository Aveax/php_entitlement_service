<?php

namespace App\Repositories\Interfaces;

interface SubscriptionRepositoryInterface
{
    public function get($subscription_id);

    public function all();
}

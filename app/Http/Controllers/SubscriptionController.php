<?php

namespace App\Http\Controllers;


use App\Services\SubscriptionService;
use App\Services\SessionsService;
use App\Services\UserService;

class SubscriptionController extends Controller
{
    public function index()
    {
        (new SessionsService)->checkIfSessionExist();

        $subs = (new SubscriptionService)->getAllSubscriptions();

        $categories = (new SubscriptionService)->getCategoriesForMultipleSubscriptions($subs);

        return view('subscription.index', compact('subs', 'categories'));
    }

    public function show($id)
    {
        (new SessionsService)->checkIfSessionExist();

        $user = (new UserService)->getLoggedUser();

        $sub = (new SubscriptionService)->getSubscription($id);

        $categories = (new SubscriptionService)->getCategoriesAsStringForSubscription($sub);

        $permission = (new SubscriptionService)->checkIfAllowedToBuySubscription($sub, $user);

        return view('subscription.single', compact('sub', 'permission', 'categories'));
    }

    public function buySubscription($id, $user_id)
    {
        (new SessionsService)->checkIfSessionExist();

        (new UserService)->buySubscription($id, $user_id);

        return redirect('subscription/'.$id);
    }
}

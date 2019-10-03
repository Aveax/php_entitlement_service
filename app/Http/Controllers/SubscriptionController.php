<?php

namespace App\Http\Controllers;


use App\Services\SubscriptionService;
use App\Services\SessionsService;
use App\Services\UserService;

class SubscriptionController extends Controller
{
    protected $SubscriptionService;
    protected $SessionsService;
    protected $UserService;

    public function __construct(SubscriptionService $SubscriptionService, SessionsService $SessionsService, UserService $UserService)
    {
        $this->SubscriptionService = $SubscriptionService;
        $this->SessionsService = $SessionsService;
        $this->UserService = $UserService;
    }

    public function index()
    {
        $this->SessionsService->checkIfSessionExist();

        $subs = $this->SubscriptionService->getAllSubscriptions();

        $categories = $this->SubscriptionService->getCategoriesForMultipleSubscriptions($subs);

        return view('subscription.index', compact('subs', 'categories'));
    }

    public function show($id)
    {
        $this->SessionsService->checkIfSessionExist();

        $user = $this->UserService->getLoggedUser();

        $sub = $this->SubscriptionService->getSubscription($id);

        $categories = $this->SubscriptionService->getCategoriesAsStringForSubscription($sub);

        $permission = $this->SubscriptionService->checkIfAllowedToBuySubscription($sub, $user);

        return view('subscription.single', compact('sub', 'permission', 'categories'));
    }

    public function buySubscription($id, $user_id)
    {
        $this->SessionsService->checkIfSessionExist();

        $this->UserService->buySubscription($id, $user_id);

        return redirect('subscription/'.$id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\SessionsService;
use App\Services\UserService;

class UserController extends Controller
{
    protected $UserService;
    protected $SessionsService;

    public function __construct(UserService $UserService, SessionsService $SessionsService)
    {
        $this->UserService = $UserService;
        $this->SessionsService = $SessionsService;
    }

    public function show($id)
    {
        $this->SessionsService->checkIfSessionExist();

        $user = $this->UserService->getUser($id);

        $permission = $this->UserService->checkIfItsLoggedUserProfile($id);

        $season_pass = $this->UserService->checkIfSeasonPassActive($user->season_pass);

        return view('user.single', compact('user', 'season_pass', 'permission'));
    }

    public function buySeasonPass($id)
    {
        $this->SessionsService->checkIfSessionExist();

        $this->UserService->buySeasonPass($id);

        return redirect('user/'.$id);
    }
}

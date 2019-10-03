<?php

namespace App\Http\Controllers;

use App\Services\SessionsService;
use App\Services\UserService;

class UserController extends Controller
{

    public function show($id)
    {
        (new SessionsService)->checkIfSessionExist();

        $user = (new UserService)->getUser($id);

        $permission = (new UserService)->checkIfItsLoggedUserProfile($id);

        $season_pass =(new UserService)->checkIfSeasonPassActive($user->season_pass);

        return view('user.single', compact('user', 'season_pass', 'permission'));
    }

    public function buySeasonPass($id)
    {
        (new SessionsService)->checkIfSessionExist();

        (new UserService)->buySeasonPass($id);

        return redirect('user/'.$id);
    }
}

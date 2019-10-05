<?php

namespace App\Services;

use App\Helpers\Datetime;
use App\Repositories\UserRepository;

class UserService
{
    protected $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function getUser($id)
    {
        return $this->UserRepository->get($id);
    }

    public function getLoggedUser()
    {
        $user = auth()->user();
        return $user;
    }

    public function checkIfItsLoggedUserProfile($id)
    {
        if($id == auth()->user()->id){
            return true;
        }
        return false;
    }

    public function checkIfSeasonPassActive($season_pass)
    {
        return (new DateTime)->checkIfNotExpired($season_pass);
    }

    public function buySeasonPass($id)
    {
        $user = $this->getUser($id);

        if( $this->checkIfItsLoggedUserProfile($id) ){
            $user->season_pass = date('Y-m-d H:i:s ', strtotime(' + 7 days'));
            $user->save();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function buySubscription($sub_id, $id)
    {
        $user = $this->getUser($id);

        if( $this->checkIfItsLoggedUserProfile($id) ){
            $user->subscription = $sub_id;
            $user->sub_end_date = date('Y-m-d H:i:s ', strtotime(' + 30 days'));
            $user->save();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}

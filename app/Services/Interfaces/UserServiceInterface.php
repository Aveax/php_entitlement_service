<?php

namespace App\Services\Interfaces;

interface UserServiceInterface
{
    public function getUser($id);

    public function getLoggedUser();

    public function checkIfItsLoggedUserProfile($id);

    public function checkIfSeasonPassActive($season_pass);

    public function buySeasonPass($id);

    public function buySubscription($sub_id, $id);
}

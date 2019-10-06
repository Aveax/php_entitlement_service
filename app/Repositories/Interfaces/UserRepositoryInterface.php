<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function get($user_id);

    public function create($request);
}

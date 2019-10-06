<?php

namespace App\Repositories\Interfaces;

interface PPVRepositoryInterface
{
    public function get($ppv_id);

    public function all();

    public function create($request);
}

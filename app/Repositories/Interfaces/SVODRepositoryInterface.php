<?php

namespace App\Repositories\Interfaces;

interface SVODRepositoryInterface
{
    public function get($svod_id);

    public function all();

    public function create($request);
}

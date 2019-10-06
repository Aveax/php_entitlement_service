<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface SVODRepositoryInterface
{
    public function get($svod_id);

    public function all();

    public function create(Request $request);
}

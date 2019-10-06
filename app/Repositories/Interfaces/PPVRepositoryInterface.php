<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface PPVRepositoryInterface
{
    public function get($ppv_id);

    public function all();

    public function create(Request $request);
}

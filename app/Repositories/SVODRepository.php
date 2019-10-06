<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SVODRepositoryInterface;
use App\SVOD;

class SVODRepository implements SVODRepositoryInterface
{
    public function get($svod_id)
    {
        return SVOD::findOrFail($svod_id);
    }

    public function all()
    {
        return SVOD::all();
    }

    public function create($request)
    {
        $svod = new SVOD([
            'title' => $request->get('title'),
            'category'=> $request->get('category'),
            'content'=> $request->get('content')
        ]);
        $svod->save();
    }
}

<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\SVOD;

class SVODRepository
{
    public function get($svod_id)
    {
        return SVOD::findOrFail($svod_id);
    }

    public function all()
    {
        return SVOD::all();
    }

    public function create(Request $request)
    {
        $svod = new SVOD([
            'title' => $request->get('title'),
            'category'=> $request->get('category'),
            'content'=> $request->get('content')
        ]);
        $svod->save();
    }
}

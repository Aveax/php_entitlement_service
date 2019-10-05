<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\PPV;

class PPVRepository
{
    public function get($ppv_id)
    {
        return PPV::findOrFail($ppv_id);
    }

    public function all()
    {
        return PPV::all();
    }

    public function create(Request $request)
    {
        $ppv = new PPV([
            'title' => $request->get('title'),
            'content'=> $request->get('content')
        ]);
        $ppv->save();
    }
}

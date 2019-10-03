<?php

namespace App\Http\Controllers;

use App\Services\SessionsService;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.create');
    }

    public function store()
    {
        (new SessionsService)->createSession();

        return redirect()->to('/');
    }

    public function destroy()
    {
        (new SessionsService)->destroySession();

        return redirect()->to('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\SessionsService;

class SessionsController extends Controller
{
    protected $SessionsService;

    public function __construct(SessionsService $SessionsService)
    {
        $this->SessionsService = $SessionsService;
    }

    public function create()
    {
        return view('session.create');
    }

    public function store()
    {
        $this->SessionsService->createSession();

        return redirect()->to('/');
    }

    public function destroy()
    {
        $this->SessionsService->destroySession();

        return redirect()->to('/');
    }
}

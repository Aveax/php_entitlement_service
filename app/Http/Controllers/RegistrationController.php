<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Services\RegistrationService;

class RegistrationController extends Controller
{
    protected $RegistrationService;

    public function __construct(RegistrationService $RegistrationService)
    {
        $this->RegistrationService = $RegistrationService;
    }

    public function create()
    {
        return view('registration.create');
    }
    public function store(RegistrationRequest $request)
    {
        $request->validated();

        $this->RegistrationService->createUserAccount($request);

        return redirect()->to('/');
    }
}

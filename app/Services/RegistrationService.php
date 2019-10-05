<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class RegistrationService
{
    protected $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }
    public function createUserAccount(Request $request)
    {
        $this->UserRepository->create($request);
    }
}

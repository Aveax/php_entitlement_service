<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class RegistrationService
{
    protected $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }
    public function createUserAccount(Request $request)
    {
        $this->UserRepository->create($request);
    }
}

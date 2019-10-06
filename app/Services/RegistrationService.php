<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\RegistrationServiceInterface;

class RegistrationService implements RegistrationServiceInterface
{
    protected $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }
    public function createUserAccount($request)
    {
        $this->UserRepository->create($request);
    }
}

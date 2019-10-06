<?php

namespace App\Services\Interfaces;

interface SessionsServiceInterface
{
    public function checkIfSessionExist();

    public function createSession();

    public function destroySession();
}

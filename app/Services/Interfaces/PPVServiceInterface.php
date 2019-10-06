<?php

namespace App\Services\Interfaces;

interface PPVServiceInterface
{
    public function getAllPPV();

    public function createPPV($request);

    public function getPPV($id);

    public function checkUserPermissionForPPV($ppv);

    public function addPermissionForPPV($id);

    public function removePermissionForPPV($id);
}

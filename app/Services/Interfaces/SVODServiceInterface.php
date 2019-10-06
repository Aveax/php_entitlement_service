<?php

namespace App\Services\Interfaces;

interface SVODServiceInterface
{
    public function getAllSVOD();

    public function getSVOD($id);

    public function createSVOD($request);

    public function getCategoryName($svod);

    public function getCategoriesNameForSVODs($svods);

    public function checkUserPermissionForSVOD($svod, $user);
}

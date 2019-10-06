<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\PPV;
use App\Repositories\Interfaces\PPVRepositoryInterface;
use App\Helpers\Datetime;

class PPVService
{
    protected $PPVRepository;

    public function __construct(PPVRepositoryInterface $PPVRepository)
    {
        $this->PPVRepository = $PPVRepository;
    }

    public function getAllPPV()
    {
        return $this->PPVRepository->all();
    }

    public function createPPV(Request $request)
    {
        $this->PPVRepository->create($request);
    }

    public function getPPV($id)
    {
        $ppv = $this->PPVRepository->get($id);

        return $ppv;
    }

    public function checkUserPermissionForPPV(PPV $ppv)
    {
        $user = auth()->user();

        $season_pass = (new DateTime)->checkIfNotExpired($user->season_pass);

        $access = $ppv->users->contains($user->id);

        return ['season_pass' => $season_pass, 'access' => $access];
    }

    public function addPermissionForPPV($id)
    {
        $ppv = $this->getPPV($id);

        $user_id = auth()->user()->id;

        if($ppv->users->contains($user_id) == null){
            $ppv->users()->attach($user_id);
        }
    }

    public function removePermissionForPPV($id)
    {
        $ppv = $this->getPPV($id);
        $user_id = auth()->user()->id;
        $ppv->users()->detach($user_id);
    }
}

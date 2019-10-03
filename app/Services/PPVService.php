<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\PPV;
use App\Helpers\Datetime;

class PPVService
{
    public function getAllPPV()
    {
        return PPV::all();
    }

    public function createPPV(Request $request)
    {
        $ppv = new PPV([
            'title' => $request->get('title'),
            'content'=> $request->get('content')
        ]);
        $ppv->save();
    }

    public function getPPV($id)
    {
        $ppv = PPV::findOrFail($id);

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

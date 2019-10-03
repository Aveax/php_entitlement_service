<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Auth;

class UserController extends Controller
{

    public function show($id)
    {

        $user = Auth::findOrFail($id);

        $permission = false;

        try{
            if($id == auth()->user()->id){
                $permission = true;
            }
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $currentDateTime = date('Y-m-d H:i:s ', time());
        $season_pass = false;
        if($currentDateTime <= $user->season_pass){
            $season_pass = true;
        }

        return view('user.single', compact('user', 'season_pass', 'permission'));
    }

    public function buySeasonPass($id)
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $user = Auth::findOrFail($id);
        $dateTime =  date('Y-m-d H:i:s ', strtotime(' + 7 days'));
        $user->season_pass = $dateTime;
        $user->save();

        return redirect('user/'.$id);
    }
}

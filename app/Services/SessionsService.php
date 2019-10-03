<?php

namespace App\Services;

class SessionsService
{
    public function checkIfSessionExist()
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }
    }

    public function createSession()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }
    }

    public function destroySession()
    {
        auth()->logout();
    }
}

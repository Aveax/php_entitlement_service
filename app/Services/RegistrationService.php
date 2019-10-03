<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\User;

class RegistrationService
{
    public function createUserAccount(Request $request)
    {
        $user = new User([
            'name' => $request->get('name'),
            'email'=> $request->get('email'),
            'password'=> $request->get('password')
        ]);

        $user->save();

        auth()->login($user);
    }
}

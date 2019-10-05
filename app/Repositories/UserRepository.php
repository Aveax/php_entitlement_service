<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\User;

class UserRepository
{
    public function get($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function create(Request $request)
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

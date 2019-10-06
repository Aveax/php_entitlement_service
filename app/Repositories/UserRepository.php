<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function get($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function create($request)
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

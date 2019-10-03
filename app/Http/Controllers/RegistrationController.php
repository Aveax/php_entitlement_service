<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User([
            'name' => $request->get('name'),
            'email'=> $request->get('email'),
            'password'=> $request->get('password')
        ]);

        $user->save();

        auth()->login($user);

        return redirect()->to('/');
    }
}

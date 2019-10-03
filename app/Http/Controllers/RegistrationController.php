<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegistrationService;

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

        (new RegistrationService)->createUserAccount($request);

        return redirect()->to('/');
    }
}

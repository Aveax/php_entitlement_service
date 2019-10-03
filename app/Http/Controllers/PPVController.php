<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PPVService;
use App\Services\SessionsService;

class PPVController extends Controller
{

    public function index()
    {
        (new SessionsService)->checkIfSessionExist();

        $ppvs = (new PPVService)->getAllPPV();

        return view('ppv.index', compact('ppvs'));
    }

    public function create()
    {
        (new SessionsService)->checkIfSessionExist();

        return view('ppv.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'content'=> 'required'
        ]);

        (new PPVService)->createPPV($request);

        return redirect('/ppv')->with('success', 'Stock has been added');
    }

    public function show($id)
    {
        (new SessionsService)->checkIfSessionExist();

        $ppv = (new PPVService)->getPPV($id);

        $permissions = (new PPVService)->checkUserPermissionForPPV($ppv);

        return view('ppv.single', compact('ppv', 'permissions'));
    }

    public function addPermission($id)
    {
        (new SessionsService)->checkIfSessionExist();

        (new PPVService)->addPermissionForPPV($id);

        return redirect('ppv/'.$id);
    }

    public function removePermission($id)
    {
        (new SessionsService)->checkIfSessionExist();

        (new PPVService)->removePermissionForPPV($id);

        return redirect('ppv/'.$id);
    }
}

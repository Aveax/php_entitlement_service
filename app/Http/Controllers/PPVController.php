<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PPVService;
use App\Services\SessionsService;

class PPVController extends Controller
{
    protected $PPVService;
    protected $SessionService;

    public function __construct(PPVService $PPVService, SessionsService  $SessionService)
    {
        $this->PPVService = $PPVService;
        $this->SessionService = $SessionService;
    }

    public function index()
    {
        $this->SessionService->checkIfSessionExist();

        $ppvs = $this->PPVService->getAllPPV();

        return view('ppv.index', compact('ppvs'));
    }

    public function create()
    {
        $this->SessionService->checkIfSessionExist();

        return view('ppv.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'content'=> 'required'
        ]);

        $this->PPVService->createPPV($request);

        return redirect('/ppv')->with('success', 'Stock has been added');
    }

    public function show($id)
    {
        $this->SessionService->checkIfSessionExist();

        $ppv = $this->PPVService->getPPV($id);

        $permissions = $this->PPVService->checkUserPermissionForPPV($ppv);

        return view('ppv.single', compact('ppv', 'permissions'));
    }

    public function addPermission($id)
    {
        $this->SessionService->checkIfSessionExist();

        $this->PPVService->addPermissionForPPV($id);

        return redirect('ppv/'.$id);
    }

    public function removePermission($id)
    {
        $this->SessionService->checkIfSessionExist();

        $this->PPVService->removePermissionForPPV($id);

        return redirect('ppv/'.$id);
    }
}

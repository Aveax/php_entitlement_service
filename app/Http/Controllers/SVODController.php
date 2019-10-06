<?php

namespace App\Http\Controllers;

use App\Http\Requests\SVODRequest;
use App\Services\Interfaces\SessionsServiceInterface;
use App\Services\Interfaces\SVODServiceInterface;
use App\Services\Interfaces\UserServiceInterface;

class SVODController extends Controller
{
    protected $SVODService;
    protected $SessionsService;
    protected $UserService;

    public function __construct(SVODServiceInterface $SVODService,
                                SessionsServiceInterface $SessionsService,
                                UserServiceInterface $UserService)
    {
        $this->SVODService = $SVODService;
        $this->SessionsService = $SessionsService;
        $this->UserService = $UserService;
    }

    public function index()
    {
        $this->SessionsService->checkIfSessionExist();

        $svods = $this->SVODService->getAllSVOD();

        $categories = $this->SVODService->getCategoriesNameForSVODs($svods);

        return view('svod.index', compact('svods', 'categories'));
    }

    public function create()
    {
        $this->SessionsService->checkIfSessionExist();

        return view('svod.create');
    }

    public function store(SVODRequest $request)
    {
        $request->validated();

        $this->SVODService->createSVOD($request);

        return redirect('/svod')->with('success', 'Stock has been added');
    }

    public function show($id)
    {
        $this->SessionsService->checkIfSessionExist();

        $svod = $this->SVODService->getSVOD($id);

        $user = $this->UserService->getLoggedUser();

        $permission = $this->SVODService->checkUserPermissionForSVOD($svod, $user);

        $category = $this->SVODService->getCategoryName($svod);

        return view('svod.single', compact('svod', 'category', 'permission'));
    }
}

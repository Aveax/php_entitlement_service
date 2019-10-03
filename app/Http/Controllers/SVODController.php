<?php

namespace App\Http\Controllers;

use App\Services\SessionsService;
use App\Services\SVODService;
use App\Services\UserService;
use Illuminate\Http\Request;

class SVODController extends Controller
{

    public function index()
    {
        (new SessionsService)->checkIfSessionExist();

        $svods = (new SVODService)->getAllSVOD();

        $categories = (new SVODService)->getCategoriesNamesForSVODs($svods);

        return view('svod.index', compact('svods', 'categories'));
    }

    public function create()
    {
        (new SessionsService)->checkIfSessionExist();

        return view('svod.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'category'=>'required|exists:categories,id',
            'content'=> 'required'
        ]);

        (new SVODService)->createSVOD($request);

        return redirect('/svod')->with('success', 'Stock has been added');
    }

    public function show($id)
    {
        (new SessionsService)->checkIfSessionExist();

        $svod = (new SVODService)->getSVOD($id);

        $user = (new UserService)->getLoggedUser();

        $permission = (new SVODService)->checkUserPermissionForSVOD($svod, $user);

        $category = (new SVODService)->getCategoryName($svod);

        return view('svod.single', compact('svod', 'category', 'permission'));
    }
}

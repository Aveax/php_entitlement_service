<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SVOD;
use App\Subscription;
use App\Helpers\Contains;
use App\Category;

class SVODController extends Controller
{

    public function index()
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $svods = SVOD::all();
        foreach ($svods as $svod) {
            $svod->category = Category::findOrFail($svod->category)->name;
        }

        return view('svod.index', compact('svods'));
    }

    public function create()
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        return view('svod.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'content'=> 'required'
        ]);
        $svod = new SVOD([
            'title' => $request->get('title'),
            'category'=> $request->get('category'),
            'content'=> $request->get('content')
        ]);
        $svod->save();
        return redirect('/svod')->with('success', 'Stock has been added');
    }

    public function show($id)
    {

        $svod = SVOD::findOrFail($id);

        $user_sub = null;
        $sub_end_date = null;

        try{
            $user_sub = Subscription::find(auth()->user()->subscription);
            $sub_end_date = auth()->user()->sub_end_date;
        }catch(\Exception $e) {
            abort(403, 'Unauthorized action.');
        }

        $permission = false;
        $currentDateTime = date('Y-m-d H:i:s ', time());

        if($user_sub != null & $currentDateTime <= $sub_end_date){
            $user_sub_categories = [];
            foreach ($user_sub->category as $category) {
                array_push($user_sub_categories, $category->id);
            }
            $con = new Contains($user_sub_categories, $svod->category);
            $permission = $con->contains();
        }

        $svod->category = Category::findOrFail($svod->category)->name;

        return view('svod.single', compact('svod', 'permission'));
    }
}

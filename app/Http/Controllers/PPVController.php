<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PPV;

class PPVController extends Controller
{

    public function index()
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $ppvs = PPV::all();

        return view('ppv.index', compact('ppvs'));
    }

    public function create()
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        return view('ppv.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'content'=> 'required'
        ]);
        $ppv = new PPV([
            'title' => $request->get('title'),
            'content'=> $request->get('content')
        ]);
        $ppv->save();
        return redirect('/ppv')->with('success', 'Stock has been added');
    }

    public function show($id)
    {

        $ppv = PPV::findOrFail($id);

        try{
            $user_id = auth()->user()->id;
            $s_p = auth()->user()->season_pass;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $exists = $ppv->users->contains($user_id);
        $currentDateTime = date('Y-m-d H:i:s ', time());

        $season_pass = false;

        if($currentDateTime <= $s_p){
            $season_pass = true;
        }

        return view('ppv.single', compact('ppv', 'season_pass', 'exists'));
    }

    public function addPermission($id)
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $ppv = PPV::findOrFail($id);
        $user_id = auth()->user()->id;
        $exists = $ppv->users->contains($user_id);
        if($exists == null){
            $ppv->users()->attach($user_id);
        }

        return redirect('ppv/'.$id);
    }

    public function removePermission($id)
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $ppv = PPV::findOrFail($id);
        $user_id = auth()->user()->id;
        $ppv->users()->detach($user_id);

        return redirect('ppv/'.$id);

        //echo $ppv->users;
    }
}

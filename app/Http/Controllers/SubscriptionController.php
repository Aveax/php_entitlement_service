<?php

namespace App\Http\Controllers;

use App\Helpers\Contains;
use Illuminate\Http\Request;
use App\Subscription;
use Illuminate\Foundation\Auth\User as Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $subs = Subscription::all();
        $categories = [];
        foreach ($subs as $sub) {
            $temp = [];
            foreach ($sub->category as $category) {
                array_push($temp, $category->name);
            }
            $temp = implode(" ", $temp);
            $categories[$sub->id] = $temp;
        }

        return view('subscription.index', compact('subs', 'categories'));
    }

    public function show($id)
    {
        $sub = Subscription::findOrFail($id);
        $sub_categories = [];
        foreach ($sub->category as $category) {
            array_push($sub_categories, $category->name);
        }

        $user_subscription = null;
        $sub_end_date = null;

        try{
            $user_subscription = Subscription::find(auth()->user()->subscription);
            $sub_end_date = auth()->user()->sub_end_date;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $difference = null;

        if($user_subscription != null){
            $user_actual_sub_categories = [];
            foreach ($user_subscription->category as $category) {
                array_push($user_actual_sub_categories, $category->name);
            }
            $con = new Contains($user_actual_sub_categories, $sub_categories);
            $difference = $con->contains();
        }

        $currentDateTime = date('Y-m-d H:i:s ', time());
        $permission = false;

        if($currentDateTime <= $sub_end_date & $difference){
            $permission = true;
        }

        $categories = implode(" ", $sub_categories);

        return view('subscription.single', compact('sub', 'permission', 'categories'));
    }

    public function buySubscription($id, $user_id)
    {
        try{
            auth()->user()->id;
        }catch(\Exception $e){
            abort(403, 'Unauthorized action.');
        }

        $user = Auth::findOrFail($user_id);
        $user->subscription = $id;
        $dateTime =  date('Y-m-d H:i:s ', strtotime(' + 30 days'));
        $user->sub_end_date = $dateTime;
        $user->save();

        return redirect('subscription/'.$id);
    }
}

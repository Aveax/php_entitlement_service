<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout');
});

Route::resource('svod', 'SVODController');
Route::resource('ppv', 'PPVController');


Route::get('/register', 'RegistrationController@create');
Route::post('register', 'RegistrationController@store');


Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');


Route::get('/user/{id}', 'UserController@show');
Route::get('/user/{id}/buy_season_pass', function () {
    return redirect('/');
});
Route::put('/user/{id}/buy_season_pass', 'UserController@buySeasonPass');


Route::get('ppv/{id}/permission', function () {
    return redirect('/');
});
Route::post('ppv/{id}/permission', 'PPVController@addPermission');
Route::delete('ppv/{id}/permission', 'PPVController@removePermission');


Route::get('subscription', 'SubscriptionController@index');
Route::get('subscription/{id}', 'SubscriptionController@show');
Route::get('subscription/{id}/buy/{user_id}', function () {
    return redirect('/');
});
Route::put('subscription/{id}/buy/{user_id}', 'SubscriptionController@buySubscription');


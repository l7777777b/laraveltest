<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	$users = new \App\User;
    //$users = new \App\User::all();

    return View::make('welcome')->with('users',$users::all());
});

Route::get('/users/{user_id?}',function($user_id){
    $user = User::find($user_id);

    return Response::json($user);
});

Route::post('/users',function(Request $request){
    $user = User::create($request->all());

    return Response::json($user);
});

Route::put('/users/{user_id?}',function(Request $request,$user_id){
    $user = User::find($user_id);

	$user->uuid = $request->uuid;
    $user->nama = $request->nama;
    $user->alamat = $request->alamat;

    $user->save();

    return Response::json($user);
});

Route::delete('/users/{user_id?}',function($user_id){
    $user = User::destroy($user_id);

    return Response::json($user);
});
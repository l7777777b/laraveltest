<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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
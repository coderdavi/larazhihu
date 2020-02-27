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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->get('/topics', function (Request $request) {
    $topics = \App\Topic::query()->select(['id','name'])->where('name','like','%'.$request->query('q').'%')
        ->get();
    return $topics;
});

Route::post('/question/follower','QuestionFollowController@follower')->middleware('auth:api');
Route::post('/question/follow','QuestionFollowController@followThisQuestion')->middleware('auth:api');
Route::get('/user/followers/{id}','FollowersController@index');
Route::post('/user/follow','FollowersController@follow');

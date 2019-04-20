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

Route::middleware('auth:api')->get('/test', function (Request $request) {
    // return $request->user();
    return 'test nga!';
});


Route::get('/users', [
    'uses'=> 'UserController@index'
]);

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('oauth/{provider}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{provider}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth_callback');
});

Route::group(['middleware' => 'auth:api'], function () {

    Route::put('/users/{user_id}', 'UserController@update');

    Route::post('/courts', 'CourtController@store');

});

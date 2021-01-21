<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;

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
Route::get('/mpesa/password', 'App\Http\Controllers\MpesaController@LipaNaMpesaPassword'); //Testing whether the password has been generated.Test on Postman (http://127.0.0.1:8000/api/mpesa/password - run a get request on postman, this should then return a base-64 encoded password)
Route::post('/mpesa/new/access/token', 'App\Http\Controllers\MpesaController@newAccessToken'); //Testing whether the token has been generated.Test on Postman (http://127.0.0.1:8000/api/mpesa/new/access/token)
Route::post('/mpesa/stk/push', 'App\Http\Controllers\MpesaController@stkPush'); //Testing whether a pop up comes on phone asking you to key in mpesa pin.Test on Postman (http://127.0.0.1:8000/api/mpesa/stk/push)
Route::post('/stk/push/callback/url', 'App\Http\Controllers\MpesaController@MpesaRes');
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\User\RegisterController;
use App\Http\Controllers\api\User\LoginController;
use App\Http\Controllers\api\ThreadController;

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

Route::group(['namespace' => 'api'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::group(['namespace' => 'User'], function(){
            Route::post('register', [RegisterController::class, 'register']);
            Route::post('login', [LoginController::class, 'login']);
        });
    });

    Route::group(['prefix' => 'threads'], function(){
        Route::get('/', [ThreadController::class, 'index']);
        Route::post('/', [ThreadController::class, 'show']);
    });
});


Route::group(['namespace' => 'api', 'middleware' => 'auth:api'], function () {
   Route::group(['prefix' => 'threads'], function () {
       Route::post('create', [ThreadController::class, 'create']);
       Route::post('remove', [ThreadController::class, 'destroy']);
   });
});

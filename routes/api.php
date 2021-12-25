<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\User\RegisterController;
use App\Http\Controllers\api\User\LoginController;
use App\Http\Controllers\api\ThreadController;
use App\Http\Controllers\api\ReplyController;

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
        Route::get('/{thread}', [ThreadController::class, 'show']);
    });
});


Route::group(['namespace' => 'api', 'middleware' => 'auth:api'], function () {
   Route::group(['prefix' => 'threads'], function () {
       Route::post('create', [ThreadController::class, 'create']);
       Route::get('{thread}/remove', [ThreadController::class, 'destroy']);
       Route::post('{thread}/add_reply', [ReplyController::class, 'store']);
   });

   Route::group(['prefix' => 'replies'], function () {
       Route::get('{reply}/remove', [ReplyController::class, 'destroy']);
       Route::post('{reply}/update', [ReplyController::class, 'update']);
   });
});

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


use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\ThreadsController;
use App\Http\Controllers\ThreadSubscriptionsController;
use App\Http\Controllers\UserNotificationsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [ThreadsController::class,'index']);


Route::get('/threads', [ThreadsController::class,'index'])->name('threads');
Route::get('/threads/{channel}/{thread}', [ThreadsController::class,'show']);
Route::delete('/threads/{channel}/{thread}', [ThreadsController::class, 'destroy'])->name('delete_thread');
Route::get('/threads/create', [ThreadsController::class,'create']);
Route::get('/threads/{channel}', [ThreadsController::class,'index']);
Route::post('/threads', [ThreadsController::class, 'store']);
Route::post('/threads/{channel}/{thread}/subscription', [ThreadSubscriptionsController::class,'store'])->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subscription', [ThreadSubscriptionsController::class, 'destroy'])->middleware('auth');


Route::post('/threads/{channel}/{thread}/addReply', [RepliesController::class, 'store']);
Route::post('/replies/{reply}/favorites', [FavoritesController::class,'store']);
Route::delete('/replies/{reply}/favorites', [FavoritesController::class,'destroy']);
Route::delete('replies/{reply}',[RepliesController::class, 'destroy']);
Route::patch('replies/{reply}',[RepliesController::class,'update']);

Route::get('/profiles/{user}', [ProfilesController::class, 'show'])->name('profile');

Route::get('/profiles/{user}/notifications', [UserNotificationsController::class, 'index']);
Route::delete('/profiles/{user}/notifications/{notification}', [UserNotificationsController::class, 'destroy']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

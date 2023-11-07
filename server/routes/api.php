<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyTokenMiddleware;
use App\Http\Controllers\ListingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('signup',[AuthController::class,'signup']);
Route::post('signin',[AuthController::class,'signin']);
Route::post('google',[AuthController::class,'google']);

Route::post('/update/{id}', [UserController::class, 'update'])->middleware('token.verify');
Route::delete('/delete/{id}', [UserController::class, 'delete'])->middleware('token.verify');
Route::get('signout', [UserController::class, 'signOut']);

Route::post('create', [ListingController::class, 'create']);
Route::get('getlistings/{id}', [ListingController::class, 'getlistings'])->middleware('token.verify');

<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return auth()->user();
});
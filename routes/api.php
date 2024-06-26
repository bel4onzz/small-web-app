<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/users', [UserController::class, 'index'])->name('get-users');
Route::get('/users/{user_id}/{action?}', [UserController::class, 'show'])->name('get-user');
Route::post('/users', [UserController::class, 'store'])->name('store-user');
Route::post('/users/{user_id}', [UserController::class, 'update'])->name('update-user');
Route::delete('/users/{user_id}', [UserController::class, 'destroy'])->name('delete-user');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\{
    BlockPageParameter,
    BlockSearchParameter
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index'])->middleware([BlockPageParameter::class, BlockSearchParameter::class])->name('home');
Route::get('/er-diagram', function(){
    return view('er-diagram');
})->middleware([BlockPageParameter::class, BlockSearchParameter::class])->name('er-diagram');
Route::get('/scoping-task', function(){
    return view('scoping-task');
})->middleware([BlockPageParameter::class, BlockSearchParameter::class])->name('scoping-task');

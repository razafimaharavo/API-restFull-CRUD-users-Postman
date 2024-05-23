<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersNakaController;

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

Route::prefix('users')->group(function(){
    Route::get('/', [UsersNakaController::class, 'get']);
    Route::post('/', [UsersNakaController::class, 'create']);
    Route::get('/{id}', [UsersNakaController::class, 'getById']);
    Route::put('/{id}', [UsersNakaController::class, 'update']);
    Route::delete('/{id}', [UsersNakaController::class, 'delete']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

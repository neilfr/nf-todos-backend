<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
    Route::get('/tasks', App\Http\Controllers\Task\IndexController::class)->name('api.tasks.index');
    Route::patch('/tasks/{task}', App\Http\Controllers\Task\UpdateController::class)->name('api.tasks.update');
    Route::post('/tasks', App\Http\Controllers\Task\StoreController::class)->name('api.tasks.store');
    Route::get('/stages', App\Http\Controllers\Stage\IndexController::class)->name('api.stages.index');


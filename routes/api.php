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

Route::middleware('auth:sanctum')->get('/tasks', App\Http\Controllers\Task\IndexController::class)->name('api.tasks.index');
Route::middleware('auth:sanctum')->patch('/tasks/{task}', App\Http\Controllers\Task\UpdateController::class)->name('api.tasks.update');
Route::middleware('auth:sanctum')->delete('/tasks/{task}', App\Http\Controllers\Task\DestroyController::class)->name('api.tasks.destroy');
Route::middleware('auth:sanctum')->post('/tasks', App\Http\Controllers\Task\StoreController::class)->name('api.tasks.store');
Route::middleware('auth:sanctum')->get('/stages', App\Http\Controllers\Stage\IndexController::class)->name('api.stages.index');


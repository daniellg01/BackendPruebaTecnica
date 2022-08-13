<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JWTController;
Route::prefix('user')->group(function () {
    Route::get('/',[ UserController::class, 'getAll']);
    Route::post('/',[ UserController::class, 'create']);
    Route::delete('/{id}',[ UserController::class, 'delete']);
    Route::get('/{id}',[ UserController::class, 'get']);
    Route::put('/{id}',[ UserController::class, 'update']);
});

Route::group(['middleware' => 'api'], function($router) {
    Route::post('login', [JWTController::class, 'login']);
});

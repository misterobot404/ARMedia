<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AlbumsController;
use App\Http\Controllers\Api\AlbumObjectsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// API Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Для авторизованных пользователей
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/albums', [AlbumsController::class, 'get']);
    Route::post('/albums', [AlbumsController::class, 'create']);
    Route::delete('/albums/{album_id}', [AlbumsController::class, 'destroy']);

    Route::get('/albums/{album_id}/objects', [AlbumObjectsController::class, 'get']);
    Route::post('/albums/{album_id}/objects', [AlbumObjectsController::class, 'create']);
    Route::delete('/albums/{album_id}/objects/{object_id}', [AlbumObjectsController::class, 'destroy']);
});



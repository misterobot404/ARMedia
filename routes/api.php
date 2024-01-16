<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\ObjectsController;
use App\Http\Controllers\Api\DealsController;
use App\Http\Controllers\Api\MessagesController;
use App\Http\Controllers\Api\ReportsController;
use App\Http\Controllers\Api\ReviewsController;
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

/*// Для всех пользователей
Route::get('/categories', [CategoriesController::class, 'index']);

Route::get('/objects', [ObjectsController::class, 'index'])->name('api.objects');
Route::get('/objects/{object}', [ObjectsController::class, 'info'])->name('api.object.info');
Route::get('/objects/same', [ObjectsController::class, 'same'])->name('api.objects.same');
Route::get('/objects/{object_id}/reviews', [ReviewsController::class, 'indexByObject']);*/

// Для авторизованных пользователей
Route::middleware('auth:api')->group(function () {
    /*Route::get('/users', [AuthController::class, 'index']);
    Route::post('/users/{user}/avatar', [AuthController::class, 'updateAvatar']);
    Route::patch('/users/{user_id}/access/{access}', [AuthController::class, 'updateAccess']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/all_objects', [ObjectsController::class, 'indexAll']);
    Route::get('/my_objects', [ObjectsController::class, 'indexMyAll']);
    Route::post('/objects', [ObjectsController::class, 'store'])->name('api.object.create');
    Route::post('/objects/{object}', [ObjectsController::class, 'update'])->name('api.object.update');
    Route::delete('/objects/{id}', [ObjectsController::class, 'destroy']);
    Route::get('/users/{user}/objects', [ObjectsController::class, 'user_objects'])->name('api.objects.byuser');
    Route::post('/objects/{id}', [ObjectsController::class, 'update']);
    Route::patch('/users/{user}/objects/{id}/confirm', [ObjectsController::class, 'confirmObject']);

    Route::get('/deals', [DealsController::class, 'index'])->name('api.deals');
    Route::get('/deals/{deal}', [DealsController::class, 'info'])->name('api.deals.info');
    Route::get('/my_deals', [DealsController::class, 'indexMy']);
    Route::get('/deals_on_my_objects', [DealsController::class, 'indexOnMyObjects']);
    Route::post('/deals', [DealsController::class, 'store'])->name('api.deals.create');
    Route::patch('/deals/{deal}/confirm', [DealsController::class, 'confirm']);
    Route::delete('/deals/{deal_id}', [DealsController::class, 'destroy']);

    Route::post('/messages', [MessagesController::class, 'store'])->name('api.messages.create');
    Route::post('/messages/{message}', [MessagesController::class, 'update'])->name('api.messages.update');
    Route::delete('/messages/{message}', [MessagesController::class, 'destroy'])->name('api.messages.delete');
    Route::get('/users/{user}/messages', [MessagesController::class, 'user_messages'])->name('api.messages.byuser');

    Route::get('/reports', [ReportsController::class, 'index']);
    Route::post('/reports', [ReportsController::class, 'store']);
    Route::delete('/reports/{report_id}', [ReportsController::class, 'destroy']);

    Route::get('/reviews', [ReviewsController::class, 'indexAll']);
    Route::post('/reviews', [ReviewsController::class, 'store']);
    Route::delete('/reviews/{review_id}', [ReviewsController::class, 'destroy']);

    Route::get('/favorites', [FavoritesController::class, 'index']);
    Route::post('/favorites', [FavoritesController::class, 'store']);
    Route::delete('/favorites/{favorite_id}', [FavoritesController::class, 'destroy']);*/
});



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\DealsController;

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

Route::get('/index', [Controller::class, 'index'])->name('index');
Route::get('/objects', [Controller::class, 'objects'])->name('objects');
Route::get('/categories', [Controller::class, 'categories'])->name('categories');
Route::get('/deals', [Controller::class, 'deals'])->name('deals');
Route::get('/reviews', [Controller::class, 'reviews'])->name('reviews');
Route::get('/messages', [Controller::class, 'messages'])->name('messages');

Route::get('/deals/{id}/contract', [DealsController::class, 'contract']);

Route::get('/{any?}', function () {
    return view('index');
})->where('any', '[\/\w\.-]*');

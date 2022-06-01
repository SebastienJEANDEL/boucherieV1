<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VideogameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// --------- VIDEOGAMES ---------

Route::get('videogames', [VideogameController::class, 'list'])
    ->name('videogames-list');

Route::post('videogames', [VideogameController::class, 'create'])
    ->name('videogames-create');

Route::get('videogames/{id}', [VideogameController::class, 'read'])
    ->name('videogame-read');

Route::get('videogames/{id}/reviews', [VideogameController::class, 'getReviews'])
    ->name('videogame-getreviews');


// --------- REVIEWS ---------

Route::get('reviews', [ReviewController::class, 'list'])
    ->name('review-list');

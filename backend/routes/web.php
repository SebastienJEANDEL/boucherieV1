<?php
use App\Http\Controllers\PieceController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\EspeceController;

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

// --------- ESPECES ---------

Route::get('especes', [EspeceController::class, 'list'])
    ->name('videogames-list');
Route::get('especes/{id}', [EspeceController::class, 'read']);


// --------- ANIMALS ---------

Route::get('animals', [AnimalController::class, 'list'])
    ->name('animals-list');
Route::get('animals/{id}', [AnimalController::class, 'read'])->name('animal-read');
Route::get('animals/{id}/pieces', [AnimalController::class, 'getPieces'])
    ->name('animal-getpieces');

// --------- RACES ---------
Route::get('races', [RaceController::class, 'list'])
    ->name('races-list');
Route::get('races/{id}', [RaceController::class, 'read']);

// --------- PRODUCERS ---------
Route::get('producers', [ProducerController::class, 'list'])
    ->name('producers-list');
Route::get('producers/{id}', [ProducerController::class, 'read']);

// --------- PIECES ---------

Route::get('pieces', [PieceController::class, 'list'])
    ->name('piece-list');
Route::get('/pieces/{id}', [PieceController::class, 'read']);
Route::post('pieces', [PieceController::class, 'create'])
    ->name('pieces-create');

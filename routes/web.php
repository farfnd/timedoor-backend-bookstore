<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BookController::class, 'index'])->name('books.index');

Route::get('/top-authors', [AuthorController::class, 'index'])->name('authors.index');

Route::prefix('input-rating')->name('ratings.')->group(function () {
    Route::get('/', [RatingController::class, 'create'])->name('create');
    Route::post('/', [RatingController::class, 'store'])->name('store');
});

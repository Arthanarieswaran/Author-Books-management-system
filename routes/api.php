<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::resource('author', AuthorController::class);
Route::resource('book', BookController::class);
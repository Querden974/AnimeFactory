<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/top', [HomeController::class, 'top'])->name('topAnime');
Route::get('/schedule', [HomeController::class, 'schedule'])->name('schedule');

Route::get('/anime', [HomeController::class, 'anime'])->name('anime');
Route::get('/anime/{malId}', [HomeController::class, 'anime'])->name('anime.show');

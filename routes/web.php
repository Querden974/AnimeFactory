<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/top', [HomeController::class, 'top'])->name('topAnime');
Route::get('/schedule', [HomeController::class, 'schedule'])->name('schedule');

Route::get('/anime', [HomeController::class, 'anime'])->name('anime');
Route::get('/anime/{malId}', [HomeController::class, 'anime'])->name('anime.show');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/',[AuthController::class, 'LoginPage'])->name('login');

    Route::get('/register',[AuthController::class, 'RegisterPage'])->name('register');
    Route::post('/register/submit',[AuthController::class, 'doRegister'])->name('register.submit');

    Route::post('/login',[AuthController::class, 'doLogin'])->name('connect');
    Route::get('/logout',[AuthController::class, 'doLogout'])->name('disconnect');

});

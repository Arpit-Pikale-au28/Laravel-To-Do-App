<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
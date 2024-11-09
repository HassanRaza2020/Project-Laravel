<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LoginController;

// Route to show the login form
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Route to handle login form submission
//Route::post('/login', [LoginController::class, 'login']);
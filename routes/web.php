<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuestionController;

// Route to show the login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route to handle login form submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route to show the signup form
Route::get('/', [AuthController::class, 'showSignUpForm'])->name('signup');

// Handle form submission for signup
Route::post('/', [AuthController::class, 'signup'])->name('auth.signup.post');

// Route to handle signup form submission
Route::post('/signup', [AuthController::class, 'signUp'])->name('signup.submit');

// Route for questions page
Route::get('/questions', [QuestionController::class, 'index'])->name('questions');

// Route to handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/AskQuestion', [QuestionController::class,'askquestion'])->name('askquestion');

Route::get('/LatestQuestion', [QuestionController::class,'latestquestion'])->name('latestquestion');

Route::get('/SearchQuestion', [QuestionController::class,'searchquestion'])->name('searchquestion');

Route::get('/Logout', [LogoutController::class,'logout'])->name('logout');

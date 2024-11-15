<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Models\Answer;
use App\Models\Content;
use App\Models\Question;
use GuzzleHttp\Psr7\Query;

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
Route::get('/questions', [QuestionController::class, 'show'])->name('questions');

// Route to handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Route::get('/AskQuestion', [QuestionController::class,'askquestion'])->name('askquestion');

Route::get('/LatestQuestion', [QuestionController::class,'latestquestion'])->name('latestquestion');

Route::get('/SearchQuestion', [QuestionController::class,'searchquestion'])->name('searchquestion');




Route::get('/Logout', [LogoutController::class,'logout'])->name('logout');



Route::get('/AskQuestion/{categoryId}', function($categoryId) {
    // Retrieve content based on the category ID
    $content = Content::find($categoryId); // This fetches a single record by ID

    // If no content is found, you can return an empty response or an error message
    if (!$content) {
        return response()->json(['error' => 'Content not found'], 404);
    }

    // Return the content as JSON (you can customize what fields to return)
    return response()->json($content);
});



Route::get('/AskQuestion', [QuestionController::class, 'showCategories'])->name('ask-questions');

Route::post('/submit-form',[QuestionController::class,'store'])->name('submit');


Route::get('/ask-answer', [AnswerController::class, 'Answerform'])->name('ask-answer');


Route::post('/answer-submit', [AnswerController::class,'Answer_Submit'])
->name('answer-submit');

Route::get('/answer-list',[AnswerController::class,'show_answer']);


Route::get('/show-answers',[AnswerController::class,'showPage'])->
name('show-answers');

Route::get('/search_questions', [QuestionController::class, 'Search_Question'])->name('search_questions');







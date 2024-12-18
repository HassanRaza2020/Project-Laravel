<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Verification;
use App\Http\Controllers\LatestQuestionsController;
use App\Http\Controllers\ChatController;
use App\Models\Chat;
use App\Models\User;
use App\Models\Question;
use Carbon\Carbon;



/*
   Route::get('/welcome', function () {
    return view('welcome');    
   }); 

   */

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/loggedIn', [AuthController::class, 'login'])->name('login_here');
        

 Route::middleware('guest')->group(function()
 
{
    //Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    //Route::post('/login', [AuthController::class, 'login'])->name('login_here');
     
    Route::get('/', [AuthController::class, 'showSignUpForm'])->name('signup');
    Route::post('/', [AuthController::class, 'signup'])->name('auth.signup.post');
    //Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/otp_verification', [Verification::class, 'verification_otp'])->name('verification_otp');
    Route::post('/resent_otp', [Verification::class, 'ResentOtp'])->name('ResentOtp');
    Route::get('/latestQuestion', [LatestQuestionsController::class, 'filter_question'])->name('latestquestion');  
    
});



 Route::middleware('auth')->group(function()
 
 {
    Route::get('/questions', [QuestionController::class, 'show'])->name('questions');
    Route::get('/search_questions', [QuestionController::class, 'Search_Question'])->name('search_questions');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/AskQuestion/{categoryId?}', [QuestionController::class, 'showCategories'])->name('ask-questions');
    Route::post('/submit-form', [QuestionController::class, 'store'])->name('submit');
    Route::get('/ask-answer', [AnswerController::class, 'Answerform'])->name('ask-answer');
    Route::post('/answer-submit', [AnswerController::class, 'Answer_Submit'])->name('answer-submit');
    Route::get('/show-answers', [AnswerController::class, 'showPage'])->name('show-answers');
    Route::delete('/delete_answer/{key}/{question_key}', [AnswerController::class,'DeleteAnswer'])->name('DeleteAnswer');
    Route::delete('/delete_question/{key}', [QuestionController::class, 'DeleteQuestion'])->name('DeleteQuestion');
    Route::put('/edit-question', [QuestionController::class, 'edit_question'])->name('edit_question');
    Route::put('/Edit-Answer', [AnswerController::class, 'Edit_Answer'])->name('edit_answer');
    // Route::get('/direct_message/{receiver_id}/{username}', [ChatController::class, 'message'])->name('message');
    // Route::get('/direct_message', function () {
    // $id = Auth::user()->id;     
    // $chat = Chat::where('sender_id', $id)->select()->get();
    // $receivers = Chat::where('sender_id', $id)
    //     ->select('receiver_name', 'receiver_id')
    //     ->distinct()
    //     ->get();

    // return view('chat.full-chat', compact('chat', 'receivers'));
    // })->name('direct-message');


   });






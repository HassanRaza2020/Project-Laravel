<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Verification;
use App\Http\Controllers\ChatController;
use App\Models\Message;
use App\Models\Chat;
use Illuminate\Http\Request;



/*
Route::get('/welcome', function () {
 return view('welcome');    
}); 
*/



Route::middleware('guest')->group(function(){

    Route::get('/', [AuthController::class, 'showSignUpForm'])->name('signup');
    Route::post('/', [AuthController::class, 'signup'])->name('auth.signup.post');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/otp_verification', [Verification::class, 'verification_otp'])->name('verification_otp');
    Route::post('/resent_otp', [Verification::class, 'ResentOtp'])->name('ResentOtp');
  
});


    Route::middleware('auth')->group(function () {
    Route::get('/questions', [QuestionController::class, 'show'])->name('questions');
    Route::get('/LatestQuestion', [QuestionController::class,'latestquestion'])->name('latestquestion');
    Route::get('/search_questions', [QuestionController::class, 'Search_Question'])->name('search_questions');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/AskQuestion/{categoryId?}', [QuestionController::class, 'showCategories'])->name('ask-questions');
    Route::post('/submit-form', [QuestionController::class, 'store'])->name('submit');
    Route::get('/ask-answer', [AnswerController::class, 'Answerform'])->name('ask-answer');
    Route::post('/answer-submit', [AnswerController::class, 'Answer_Submit'])->name('answer-submit');
    Route::get('/show-answers', [AnswerController::class, 'showPage'])->name('show-answers');
    Route::delete('/delete_answer/{key}/{question_key}', [AnswerController::class,'DeleteAnswer'])->name('DeleteAnswer');
    Route::delete('/delete_question/{key}', [QuestionController::class, 'DeleteQuestion'])->name('DeleteQuestion');
    Route::put('/edit-question/{key}', [QuestionController::class, 'edit_question'])->name('edit_question');
    Route::put('/Edit-Answer/{key}', [AnswerController::class, 'Edit_Answer'])->name('edit_answer');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');



    Route::get('/direct_message', function()
    { 
          $id=Auth::user()->id;
          $chat = Chat::where('sender_id', $id)->select()->get();
                    
        return view('chat.chat_module',['chat'=>$chat]); })->name('direct-message');
      
});


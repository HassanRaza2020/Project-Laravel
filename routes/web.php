<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\Verification;
use App\Http\Controllers\LatestQuestionsController;
use Illuminate\Http\Client\Request;

/*
   Route::get('/welcome', function () {
    return view('welcome');    
   }); 

   */

    
    Route::middleware('guest')->group(function()
 
{ 

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/loggedIn', [AuthController::class, 'login'])->name('login_here');
     
    Route::get('/', [AuthController::class, 'showSignUpForm'])->name('signup');
    Route::post('/', [AuthController::class, 'signup'])->name('auth.signup.post');
   
    Route::post('/otp_verification', [Verification::class, 'verification_otp'])->name('verification_otp');
    Route::post('/resent_otp', [Verification::class, 'ResentOtp'])->name('ResentOtp');
    Route::get('/latestQuestion', [LatestQuestionsController::class, 'filter_question'])->name('latestquestion');  
    Route::get('/forgetpassword', function(){return view('auth.forget-password');})->name('forget-password');
    Route::get('/redirect-to-mail', [ForgetPasswordController::class, 'forget_password'])->name('module.redirect');
    Route::put('/password_reset', [ForgetPasswordController::class, 'confirm_password'])
    ->name('confirm_password');
       

    
});



 Route::middleware('auth')->group(function()
 
 {
    Route::get('/questions', [QuestionController::class, 'show'])->name('questions');
    Route::get('/search-questions', [QuestionController::class, 'SearchQuestion'])->name('search-questions');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/ask-question', [QuestionController::class, 'showCategories'])->name('ask-questions');
    Route::post('/submit-form', [QuestionController::class, 'store'])->name('submit');
    Route::get('/ask-answer', [AnswerController::class, 'Answerform'])->name('ask-answer');
    Route::post('/answer-submit', [AnswerController::class, 'AnswerSubmit'])->name('answer-submit');
    Route::get('/show-answers', [AnswerController::class, 'showPage'])->name('show-answers');
    Route::delete('/delete-answer/{key}/{question_key}', [AnswerController::class,'DeleteAnswer'])->name('DeleteAnswer');
    Route::delete('/delete-question/{key}', [QuestionController::class, 'DeleteQuestion'])->name('DeleteQuestion');
    Route::put('/edit-question', [QuestionController::class, 'edit_question'])->name('edit_question');
    Route::put('/edit-answer', [AnswerController::class, 'EditAnswer'])->name('edit_answer');
   
    
    // Ensures the link is signed

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



   // Route for handling the "forget password" logic
   
   // Route for displaying the password confirmation page
   Route::get('/redirect-to-password/{email}', function ($email) {
    
    return view('auth.confirm-password', compact('email'))
    ;})->name('module.redirected')->middleware(['guest','signed']);


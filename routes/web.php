<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\LatestQuestionsController;


Route::group(['middleware' => 'guest'], function() //Using the guest middleware for unauthenticated users
 
{ 

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); //displaying the login page
    Route::post('/login', [AuthController::class, 'loginForm'])->name('login-here'); //posting the login request
    Route::get('/', [AuthController::class, 'showSignUpForm'])->name('view-signup'); // displaying the signup page
    //Route::post('/post-signup',[AuthController::class, 'signupForm'])->name('signup');  //
    Route::get('/view-otp-verification',[VerificationController::class, 'viewOtpVerification'])->name('view-verification-otp')->middleware('prevent-back-button');
    Route::post('/verification-otp', [VerificationController::class, 'verificationOtp'])->name('verification-otp'); //sending the otp request for email verification
    Route::post('/resent-otp', [VerificationController::class, 'resentOtp'])->name('resend-otp');// posting the resent request when the opt gets expire after 2 mins
    Route::get('/latest-question', [LatestQuestionsController::class, 'filterQuestion'])->name('latest-question');  //fitering the question which has been posted recently within one day
    Route::get('/forget-password', function(){return  view('auth.forget-password'); })->name('forget-password');  //displaying the forget password page
    Route::get('/password-reset', [ForgetPasswordController::class, 'forgetPassword'])->name('forget-password.redirect'); // sending the email for reseting the password
    Route::put('/password-reset', [ForgetPasswordController::class, 'confirmPassword'])->name('confirm-password');// displayong the confirm password page
    Route::get('/redirect-to-password/{email}', [ForgetPasswordController::class, 'redirectToResetPassword'])->name('forgetpassword-link.redirected')->middleware('signed');
    
           
});


Route::group(['middleware' => 'auth'], function() { 
    Route::get('/questions', [QuestionController::class, 'show'])->name('questions'); //display the questions
    Route::get('/search-questions', [QuestionController::class, 'searchQuestion'])->name('search-questions'); //search query for searching the results
    Route::get('/logout', [LogoutController::class, 'logOut'])->name('logout'); //ending the session by logout button
    Route::get('/ask-question', [QuestionController::class, 'categoriesList'])->name('ask-questions'); //displaying the cateogories
    Route::post('/submit-form', [QuestionController::class, 'storeQuestion'])->name('submit'); // storing the questions
    Route::post('/answer-submit', [AnswerController::class, 'answerSubmit'])->name('answer-submit');//storing the answers
    Route::get('/show-answers', [AnswerController::class, 'showPage'])->name('show-answers'); //displaying the answers 
    Route::delete('/delete-answer/{answerKey}/{questionKey}', [AnswerController::class,'deleteAnswer'])->name('delete-answer'); //deleting the answers
    Route::delete('/delete-question/{questionKey}', [QuestionController::class, 'deleteQuestion'])->name('delete-question'); // deleting the questions
    Route::put('/edit-question', [QuestionController::class, 'editQuestion'])->name('edit-question'); //editing the questions  
    Route::put('/edit-answer', [AnswerController::class, 'editAnswer'])->name('edit-answer'); //editing the answers
   
   });

   
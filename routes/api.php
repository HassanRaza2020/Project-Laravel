<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;


/*
Route::post('/send-message', [ChatController::class, 'sendMessage'])->middleware('auth:sanctum')->name('send-message');

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/send-message', [ChatController::class, 'sendMessage'])
// ->middleware('auth:sanctum')
// ->name('send-message');



// In routes/api.php


    
   Route::get('/test',function(){
      return response()->json(['message'=>'Hello from Laravel API']);
   });
    
   Route::post('/signup',[AuthController::class, 'signupForm'])->name('signup');
   Route::post('/signup',function(Request $request){ return response()->json(['message' => 'Data received', 'data' => $request->all()]);}); 
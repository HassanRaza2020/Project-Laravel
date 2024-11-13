<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;



class AnswerController extends Controller
{

public function Answerform(){

    
    return view('questions.ask-answer');
}


public function Answer_Submit( Request $request){

$request ->validate([
    'Description'=>'required|string|max:255'
]);




Answer::create([

    'user_id' => auth()->id(), // Assuming the user is logged in
    'username' => auth()->user()->username,
    'Description' => $request->input('Description'),


]);




}



}
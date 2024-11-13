<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;



class AnswerController extends Controller
{

public function Answerform(Request $request){
    
  
    //dd($request->key);
    $question = Question::all();

     
    return view('questions.ask-answer',compact('question'));
    
}


public function Answer_Submit(Request $request)
{
    //dd($request->all());
    //dd($request);
    // Validate the request
    $request->validate([
        'Description' => 'required|string|max:255',
    ]);

    // Create the answer using the key as question_id
    Answer::create([
        'user_id' => auth()->id(), // Assuming the user is logged in
        'Username' => auth()->user()->username,
        'Description' => $request->input('Description'),
        'question_id' => $request->input('question_id'),

    ]);

   // dd($request);

    // Redirect back to the same page with a success message
    return back()->with('success', 'Answer submitted successfully!');
}

public function show_answer()
{
    $user = Answer::where('username', 'Hassan Raza')->get();

    return view('questions.answers-list', compact('user'));


}



}
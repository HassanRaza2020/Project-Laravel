<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Contracts\View\View;

class AnswerController extends Controller
{

public function Answerform(Request $request){
    
  
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
    return redirect()->back()->with('success', 'Your answer has been submitted!');
}

public function show_answer()
{

    $key = session('key_value');
    //dd($key);

    $query = Answer::where('question_id', $key)->select('Description')->get();
    
    //dd($query);

    return view('questions.answers-list', compact('query'));
        
}

public function showPage(Request $request){

    $key = $request->key;
    
    $question = Question::all();
    
    $query = Answer::where('question_id', $key)->select('Description')->get();
   
    $user =  auth()->user()->username;
    

    return view('questions.main-page',compact('question','query','user'));
    
}





}
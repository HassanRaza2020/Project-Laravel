<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Contracts\View\View;

class AnswerController extends Controller
{

    /*
public function Answerform(Request $request)
{
      
    $key = $request->key;
    dd($key);
    $question = Question::where('question_id',$key)->first();     
    return view('questions.ask-answer',compact('question'));
    
}
    */


public function Answer_Submit(Request $request)
{
    //dd($request->all());
    //dd($request);
    // Validate the request
    $request->validate([
        'Description' => 'required|string|max:2000'
    ]);

    // Create the answer using the key as question_id
    Answer::create([
        'user_id' => auth()->id(), // Assuming the user is logged in
        'Username' => auth()->user()->username,
        'Description' => $request->input('Description'),
        'question_id' => $request->input('question_id'),
         ]);

/*
      $data=['user_id' => auth()->id(), // Assuming the user is logged in
        'Username' => auth()->user()->username,
        'Description' => $request->input('Description'),
        'question_id' => $request->input('question_id'),];   
*/
     //dd($data);

         

    // Redirect back to the same page with a success message
    return redirect()->back()->with('success', 'Your answer has been submitted!');
}



public function showPage(Request $request)
{

    $key = $request->key;

    $question = Question::where('question_id',$key)->select('question_id','title','Description')->first();
     
    //$question = Question::where('question_id',$key)->first();     
    
    $query = Answer::where('question_id', $key)->select('Description','username')->get();

   
    return view('questions.main-page',compact('question','query'));
    
}


}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


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

    try {
        $key = urldecode($request->key);
        $key_decrypted = Crypt::decrypt($key);

        // Fetch question
        $question = Question::where('question_id', $key_decrypted)
            ->select('question_id', 'title', 'Description', 'user_id', 'created_at','username')
            ->first();
            

        // Fetch related answers
        $query = Answer::where('question_id', $key_decrypted)
            ->select('user_id', 'answer_id', 'Description', 'username', 'created_at')
            ->get();

        return view('questions.main-page', compact('question', 'query'));
    } 
    
    
    catch (DecryptException $e) {
        return redirect()->route('error.page')->with('error', 'Invalid or tampered key!');
    }

    } 
    



public function DeleteAnswer($key,$question_key){


    Answer::where('answer_id', $key)->delete();

    Question::where('question_id',$question_key)->select('question_id','title','Description')->first();

     Answer::where('question_id', $key)->select('answer_id','Description','username')->get();

    return redirect()->back();

}


 public function Edit_Answer(Request $request){
   $key = $request->input('answer_id');
   $edit_answer = Answer::find($key);
   $edit_answer -> description = $request->input('description');
   $edit_answer->save();
   return redirect()->back()->with('status', 'Answer updated successfully');

 }


}
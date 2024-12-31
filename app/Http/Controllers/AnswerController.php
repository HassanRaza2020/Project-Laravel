<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


 class AnswerController extends Controller
 {



  public function answerSubmit(Request $request)
  {
    $request->validate
    ([
        'Description' => 'required|string|max:2000' 
    ]);

    // Create the answer using the key as question_id
    Answer::create([
        'user_id' => auth()->id(), 
        'Username' => auth()->user()->username,
        'Description' => $request->Description,
        'question_id' => $request->question_id]);

        
    // Redirect back to the same page with a success message
    return redirect()->back()->with('success', 'Your answer has been submitted!');
}





    public function showPage(Request $request)
    {

    try {
        $key = urldecode($request->key);
        $key_decrypted = Crypt::decrypt($key);

        // Fetch question
        $question = Question::where('question_id', $key_decrypted)->first(); //encrypting the question id request
            

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
    



   public function deleteAnswer($answerId,$questionKey){  //deleting the answers using question_id and answer_id


     Answer::where('answer_id', $answerId)->delete();

     Question::where('question_id',$questionKey)->select('question_id','title','Description')->first();

     Answer::where('question_id', $answerId)->select('answer_id','Description','username')->get();

     return redirect()->back(); //redirecting the page back the with no content

}


 public function editAnswer(Request $request){  //editing the answers
      $editAnswer = Answer::find($request->answer_id); //fetching the answer_id
      $editAnswer -> description = $request->description; //editing the answer
      $editAnswer->save(); //saving the updated answer
      return redirect()->back()->with('status', 'Answer updated successfully');

 }


}
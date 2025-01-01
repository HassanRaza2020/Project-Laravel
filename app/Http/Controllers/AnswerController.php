<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{

    public function answerSubmit(Request $request)
    {
        // $request->validate
        //     ([
        //     'Description' => 'required|string|max:2000',
        // ]);

        $validator = Validator::make($request->all(), [ //creating the form validation for SignUp
            'Description' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {  //if validations fails, errors are handled from the this condition
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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
            $key_decrypted = Crypt::decrypt($key); //decrypting the key after the request has been posted

            // Fetch question
            $question = Question::where('question_id', $key_decrypted)->first(); //encrypting the question id request

            // Fetch related answers
            $query = Answer::where('question_id', $key_decrypted)
                ->select('user_id', 'answer_id', 'Description', 'username', 'created_at')
                ->get();

            return view('questions.main-page', compact('question', 'query'));
        } catch (DecryptException $e) {
            return redirect()->route('error.page')->with('error', 'Invalid or tampered key!');
        }

    }

    public function deleteAnswer($answerId, $questionKey)
    { //deleting the answers using question_id and answer_id

        Answer::where('answer_id', $answerId)->delete(); //delete query using the where clause

        Question::where('question_id', $questionKey)->select('question_id', 'title', 'Description')->first(); //selecting the columns

        Answer::where('question_id', $answerId)->select('answer_id', 'Description', 'username')->get();  //after deleting the answer, this query will show all answers

        return redirect()->back(); //redirecting the page back the with no content

    }

    public function editAnswer(Request $request)
    {                                                     //editing the answers
        $editAnswer = Answer::find($request->answer_id); //fetching the answer_id
        $editAnswer->description = $request->description; //editing the answer
        $editAnswer->save(); //saving the updated answer
        return redirect()->back()->with('status', 'Answer updated successfully');  //returns to page with this message

    }

}

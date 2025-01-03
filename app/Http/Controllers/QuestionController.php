<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Content;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    // Show categories for the ask-question form
    public function askQuestion()
    {
        // Fetching all categories with 'content_id' and 'content_name'
        $categories = Content::select('content_id', 'content_name')->get();

        // Pass categories to the view
        return view('questions.askquestion', compact('categories'));

    }

    public function store(QuestionRequest $request)
    {

        // Create a new question record
        Question::create([
            'user_id' => auth()->id(), // Assuming the user is logged in
            'username' => auth()->user()->username,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->category,
        ]);

        // Redirect with success message

        return redirect()->route('questions')->with('success', 'Question submitted successfully!');

    }

    public function show()
    {

        $questions = Question::all();

        return fn()=>view('questions.questions', compact('questions'));

    }

    public function searchQuestion(Request $request)
    {

        if ($request->has('query')) { // Check if there is a query, and filter results accordingly
            $questions = Question::where('title', 'LIKE', "%{$request->input('query')}%")->get();
        }

        return view('questions.questions', compact('questions'));

    }

    public function deleteQuestion($key)
    {
        Question::where('question_id', $key)->delete(); //delete request for questions
        Question::all();
        // Return the view with the updated questions
        return response()->noContent();
    }

    public function editQuestion(QuestionRequest $request)     //edithg the questions
    {                                                               
        $editQuestion = Question::find($request->question_id);
        $editQuestion->title = $request->title;
        $editQuestion->description = $request->description;
        $editQuestion->save(); //saving the updated question
        return redirect()->back()->with('status', 'Question updated successfully');

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        // Return the questions view
        return view('questions.questions'); // Laravel will look for resources/views/questions/questions.php
    }

    public function askquestion(){
         return view('questions.askquestion');
    }

    
    public function latestquestion(){
        return view('questions.latestquestion');
   }

   public function searchquestion(){
        return view('questions.searchquestion');
   }

    // Show categories for the ask-question form
    public function showCategories()
    {
        // Fetch all categories (content names) from the Content model
        $categories = Content::all();

        // Pass categories to the view
        return view('questions.askquestion', compact('categories'));
    }


    public function store(Request $request){
          $request->validate([
          'title'=>'required|string|max:255',
          'description'=>'required|string|max:2000' ,
          'content'=> 'required|string'   
     ]);



    // Create a new question record
    Question::create
    ([
     'user_id' => auth()->id(), // Assuming the user is logged in
     'username' => auth()->user()->username,
     'title' => $request->title,
     'description' => $request->description,
     'category_id' => $request->category, // This should match the category_id column in your Question model/table
     ]);

 // Redirect with success message
 return redirect()->route('questions')->with('success', 'Question submitted successfully!');




    }



    


}

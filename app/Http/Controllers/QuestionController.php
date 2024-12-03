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
      // Fetching all categories with 'content_id' and 'content_name'
    $categories = Content::select('content_id', 'content_name')->get();

    // Pass categories to the view
    return view('questions.askquestion', compact('categories'));
        
    }


    public function store(Request $request){
      
     $request->validate([

          'title'=>'required|string|max:255',
          'description'=>'required|string|max:2000' ,
          'category' => 'required|exists:content,content_id',   
     
     ]);



    // Create a new question record
      Question::create ([
     'user_id' => auth()->id(), // Assuming the user is logged in
     'username' => auth()->user()->username,
     'title' => $request->title,
     'description' => $request->description,
     'content' => $request->category, 
     ]);
     

 // Redirect with success message
      
 return redirect()->route('questions')->with('success', 'Question submitted successfully!');

  //return response()->json($questions);

    }


    public function show(){

     $questions = Question::select('username','title','question_id','user_id','created_at')->get();
 //    dd($questions);
     
    $questions = Question::all();

     return view('questions.questions', compact('questions'));
     
     }
    
     public function Search_Question(Request $request){
      
          $query = $request->input('query');    
      
          // Check if there is a query, and filter results accordingly
          if ($query) {
              $search_questions = Question::where('title', 'LIKE', "%{$query}%")->get();
              //dd($search_questions);
          } else {
              $search_questions = Question::all();
          }
      
          // Return to the question list view with the search results
          return view('questions.searchquestion', compact('search_questions', 'query'));
      }

      public function DeleteQuestion($key)
     
      {
                    
           Question::where('question_id', $key)->delete();

           Question::all();    
          // Return the view with the updated questions
          
          //return view('questions.questions', compact('questions'));

           return  response()->noContent();
        }


        public function edit_question(Request $request, $key){
            
            $edit_question = Question::find($key);
            $edit_question ->title = $request->input('title');
            $edit_question ->description = $request->input('description');
            
            $edit_question->save();

            
            return redirect()->back()->with('status', 'Question updated successfully');

        }


        public function Contentlist(){
            
            $content = Content::select('content_id', 'content_name')->get();

            return view('questions.questions',compact('content'));


        }


       
      
}

<?php

namespace App\Http\Controllers;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LatestQuestionsController extends Controller
{

   public function filter_question()
   {

    $questions = Question::all();

    $timestamp = Question::select('title','created_at', 'updated_at')->get();
    

    return view('questions.latestquestion', compact('questions'));


     } 


}

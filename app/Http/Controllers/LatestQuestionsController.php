<?php

namespace App\Http\Controllers;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LatestQuestionsController extends Controller
{

   public function filterQuestion()
   {
    $questions = Question::all();
    return view('questions.latestquestion', compact('questions'));
   } 

}

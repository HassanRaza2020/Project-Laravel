<?php

namespace App\Http\Controllers;

use App\Models\Question;

class LatestQuestionsController extends Controller
{

    public function filterQuestion()
    {
        $questions = Question::all();
        return view('questions.latestquestion', compact('questions'));
    }

}

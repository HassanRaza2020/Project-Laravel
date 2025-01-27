<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Services\QuestionService;

class LatestQuestionsController extends Controller
{


    protected $questionService;


    public function __construct(QuestionService $questionService)  //injecting the service class in the controller
    {
        $this->questionService = $questionService;
        
    }

    public function filterQuestion()
    {
        $questions = $this->questionService->getAllQuestion();   //latest question filter by conditioniing 
        return view('questions.latestquestion', compact('questions'));
    }

}

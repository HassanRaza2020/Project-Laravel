<?php


namespace App\Repositories;

use App\Models\Question;
use App\Models\Answer;

class DisplayQuestionDetailsRepository
{

  protected $answerRepo, $questionRepo;

  public function __construct(Answer $answerRepo, Question $questionRepo)
  {
    $this->answerRepo = $answerRepo;
    $this->questionRepo = $questionRepo;
  }

  public function displayQuestionDetails($questionId){
    return $this->questionRepo::where('question_id',$questionId)->select('title','description')->first();

  }

  public function displayAnswerList($questionId){
    return $this->answerRepo::where('question_id',$questionId)->select('Description','Username','updated_at')->first();
  }
   
}

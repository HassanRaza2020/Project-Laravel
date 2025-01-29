<?php
namespace App\Repositories;

use App\Models\Answer;
use App\Models\Question;

class DisplayQuestionDetailsRepository
{
    protected $answerRepo, $questionRepo;

    public function __construct(Answer $answerRepo, Question $questionRepo)
    {
        $this->answerRepo   = $answerRepo;
        $this->questionRepo = $questionRepo;
    }

    public function displayQuestionDetails($questionId)
    {
        return $this->questionRepo::where('question_id', $questionId)->select('title', 'description', 'question_id')->first(); //query for question details display

    }

    public function displayAnswerList($questionId)
    {

        return $this->answerRepo::where('question_id', $questionId)->select('Description', 'Username', 'updated_at')->get(); //query for answers details display

    }

}

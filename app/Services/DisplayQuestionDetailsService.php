<?php
namespace App\Services;

use App\Repositories\DisplayQuestionDetailsRepository;

class DisplayQuestionDetailsService
{

    protected $displayQuestionDetailsService;

    public function __construct(DisplayQuestionDetailsRepository $displayQuestionDetailsService)
    {
        $this->displayQuestionDetailsService = $displayQuestionDetailsService;
    }

    public function displayQuestionDetails($questionId)
    {

        $questionKey = $this->displayQuestionDetailsService->displayQuestionDetails(decrypt($questionId->key)); //displaying the question details   
        $answerKey = $this->displayAnswerList($questionId->key);                                       //decrypting the question_id
        return   $answerKey;

    }

    public function displayAnswerList($questionId)
    {
        $key = decrypt($questionId->key);                                     //decrypting the question_id
        return $this->displayQuestionDetailsService->displayAnswerList($key); //method for answers display

    }

}

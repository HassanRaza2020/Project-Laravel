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

        $key = decrypt($questionId->key);                                          //decrypting the question_id
        return $this->displayQuestionDetailsService->displayQuestionDetails($key); //displaying the question details

    }

    public function displayAnswerList($questionId)
    {
        $key = decrypt($questionId->key);                                     //decrypting the question_id
        return $this->displayQuestionDetailsService->displayAnswerList($key); //method for answers display

    }

}

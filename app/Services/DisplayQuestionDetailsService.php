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
        $this->displayAnswerList($questionId);      
        return $this->displayQuestionDetailsService->displayQuestionDetails($questionId); //displaying the question details 
    }

    public function displayAnswerList($questionId)
    {                                                                                 
        return $this->displayQuestionDetailsService->displayAnswerList($questionId); //method for answers display
    }
}

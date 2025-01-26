<?php

namespace App\Services;
use App\Repositories\DisplayQuestionDetailsRepository;


class DisplayQuestionDetailsService{

protected $displayQuestionDetailsService;

public function __construct(DisplayQuestionDetailsRepository $displayQuestionDetailsService)
{
    $this->displayQuestionDetailsService = $displayQuestionDetailsService;
}


public function displayQuestionDetails($questionId){
    
    $key = decrypt($questionId->key);
    return $this->displayQuestionDetailsService->displayQuestionDetails($key);
 
  }

  public function displayAnswerList($questionId){
    $key = decrypt($questionId->key);
    return $this->displayQuestionDetailsService->displayAnswerList($key);
    
  }





}
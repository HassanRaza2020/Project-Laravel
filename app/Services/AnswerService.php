<?php

namespace App\Services;

use App\Repositories\AnswerRepository;

class AnswerService{

protected $answerRepository;

public function __construct(AnswerRepository $answerRepository)  //injecting the constructor of Repo class
{
     $this->answerRepository = $answerRepository;      
}

public function getAllAnswer(){
    return $this->answerRepository->getAllAnswer();  //calling the getAllQuestion method
}

public function createAnsert($data){
    return $this->answerRepository->createAnswer($data);  //calling the createQuestion method
}

public function deleteAnswer($id){
    return $this->answerRepository->deleteAnswer($id);  //calling the deleteQuestion method
}

public function findAnswer($id){
    return $this->answerRepository->findAnswerById($id);  //calling the findQuestion method
}


public function updateAnswer($id, $data){
 
    return $this->answerRepository->updateAnswer($id, $data);  //calling the updateQuestion

}


}
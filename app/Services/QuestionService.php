<?php

namespace App\Services;

use App\Repositories\QuestionRepository;

class QuestionService{

protected $questionRepository;

public function __construct(QuestionRepository $questionRepository)  //injecting the constructor of Repo class
{
     $this->questionRepository = $questionRepository;      
}

public function getAllQuestion(){
    return $this->questionRepository->getAllQuestion();  //calling the getAllQuestion method
}

public function createQuestion($data){
    return $this->questionRepository->createQuestion($data);  //calling the createQuestion method
}

public function deleteQuestion($id){
    return $this->questionRepository->deleteQuestion($id);  //calling the deleteQuestion method
}

public function findQuestion($id){
    return $this->questionRepository->findQuestionById($id);  //calling the findQuestion method
}

public function searchQuestion($query){
    return $this->questionRepository->searchQuestion($query);  //calling the searchQuestion
   
}

public function updateQuesion($id, $data){
 
    return $this->questionRepository->updateQuestion($id, $data);  //calling the updateQuestion

}







}
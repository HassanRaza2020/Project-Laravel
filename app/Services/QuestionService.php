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

public function create($data){
    return $this->questionRepository->createQuestion($data);  //calling the createQuestion method
}

public function delete($id){
    return $this->questionRepository->deleteQuestion($id);  //calling the deleteQuestion method
}

public function find($id){
    return $this->questionRepository->findQuestionById($id);  //calling the findQuestion method
}

public function search($query){
    return $this->questionRepository->searchQuestion($query);  //calling the searchQuestion
   
}

public function update($id, $data){
 
    return $this->questionRepository->updateQuestion($id, $data);  //calling the updateQuestion

}







}
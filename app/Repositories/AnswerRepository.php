<?php

namespace App\Repositories;
use App\Models\Answer;

class AnswerRepository {

    protected $answerRepo;
    public function __construct(Answer $answerRepo)  //injecting the service class in the controller
    {
        $this->answerRepo = $answerRepo;
        
    }
  
    public function getAllAnswer(){
        return $this->answerRepo::all();   //creating getAllQuestion function
        
    }


    public function createAnswer($data){

        return $this->answerRepo::create($data);   //creating createQuestion function
    }


    public function findAnswerById($id){
        return $this->answerRepo::where('question_id', $id)->get();  //creating findQuestionById function
    }


    public function deleteAnswer($id){

        return $this->answerRepo::where('answer_id', $id)->delete(); //creating deleteQuestion function

    }


    public function edit($data){ 
        return $this->answerRepo::find($data->answer_id);  //creating edit answer function
           
    }


}

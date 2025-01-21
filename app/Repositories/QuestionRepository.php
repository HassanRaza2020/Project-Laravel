<?php

namespace App\Repositories;
use App\Models\Question;

class QuestionRepository{
    protected $questionRepo;
    public function __construct(Question $questionRepo)  //injecting the service class in the controller
    {
        $this->questionRepo = $questionRepo;
        
    }
  
    public function getAllQuestion(){
        return $this->questionRepo::all();   //creating getAllQuestion function
        
    }

    public function createQuestion($data){
        // Create a new question record
        Question::create([
            'user_id'     => auth()->id(), // Assuming the user is logged in
            'username'    => auth()->user()->username,
            'title'       => $data->title,
            'description' => $data->description,
            'content'     => $data->category,
        ]);

       
    }


    public function findQuestionById($id){
        return $this->questionRepo::find($id);  //creating findQuestionById function
    }


    public function searchQuestion($query){
         
        return $this->questionRepo::where('title', 'LIKE', "%{query}%")->get();  //creating searchQuestion function

    }

    public function deleteQuestion($id){

        return $this->questionRepo::where('question_id', $id)->delete(); //creating deleteQuestion function

    }


    public function updateQuestion($id,$data){ 
        $question  = $this->findQuestionById($id);  //creating updateQuestion function
        $question->update($data);
        return $question;

    }


}

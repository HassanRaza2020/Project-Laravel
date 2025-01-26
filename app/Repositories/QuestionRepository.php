<?php

namespace App\Repositories;
use App\Models\Question;
use App\Models\Content;

class QuestionRepository{
    protected $questionRepo, $categoriesList;
    public function __construct(Question $questionRepo, Content $categoriesList )  //injecting the service class in the controller
    {
        $this->questionRepo = $questionRepo;
        $this->categoriesList = $categoriesList; 
        
    }
  
    public function getAllQuestion(){
        return $this->questionRepo::all();   //creating getAllQuestion function
        
    }
   


    public function categoriesList(){
      return  $this->categoriesList = Content::select('content_id', 'content_name')->get();
    
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

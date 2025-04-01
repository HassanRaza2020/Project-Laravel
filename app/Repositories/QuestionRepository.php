<?php
namespace App\Repositories;

use App\Models\Content;
use App\Models\Question;




class QuestionRepository
{
    protected $questionRepo, $categoriesList;
    public function __construct(Question $questionRepo, Content $categoriesList) //injecting the service class in the controller
    {
        $this->questionRepo   = $questionRepo;
        $this->categoriesList = $categoriesList;

    }

    public function getAllQuestion()
    {
        return $this->questionRepo::all(); //creating getAllQuestion function

    }

    public function categoriesList()
    {
        return $this->categoriesList::select('content_id', 'content_name')->get();

    }

    public function createQuestion($data)
    {
        
        // Create a new question record
        Question::create([
            'user_id'     => $data->data['user_id'], // Assuming the user is logged in
            'username'    => $data->data['username'],
            'title'       => $data->data['title'],
            'description' => $data->data['description'],
            'category_name' => $data->data['category_name'],
        ]);

    }

    public function findQuestionById($id)
    {
        return $this->questionRepo::find($id); //creating findQuestionById function
    }

    public function searchQuestion($query)
    {   
        return $this->questionRepo::where('title', 'LIKE', "%{$query}%")->get(); //creating searchQuestion function
    }

    public function deleteQuestion($id)
    {

        return $this->questionRepo::where('question_id', $id)->delete(); //creating deleteQuestion function

    }

    public function updateQuestion($id, $data)
    {
     //    Log::info("Question Repo:",$id);
        $question = $this->findQuestionById($id); //creating updateQuestion function
        $question->update($data);
        return $question;

    }

    public function dashBoardCount(){
        $totalCount = Question::selectRaw('category_name, COUNT(*) as total')
        ->groupBy('category_name')
        ->get();

        return response()->json($totalCount);

    }

}

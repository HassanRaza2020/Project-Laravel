<?php
namespace App\Services;

use App\Repositories\QuestionRepository;

class QuestionService
{

    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository) 
    {
        $this->questionRepository = $questionRepository;
    }

    public function getAllQuestion()
    {
        return $this->questionRepository->getAllQuestion(); //calling the getAllQuestion method
    }

    public function create($data)
    {
        return $this->questionRepository->createQuestion($data); //calling the createQuestion method
    }

    public function delete($id)
    {
        $this->questionRepository->deleteQuestion($id); //calling the deleteQuestion method
        return redirect()->back();
    }

    public function find($id)
    {
        return $this->questionRepository->findQuestionById($id); //calling the findQuestion method
    }

    public function search($query)
    {
        return $this->questionRepository->searchQuestion($query); //calling the searchQuestion

    }

    public function edit($data)
    {
        $selectedField = $data->only(['title', 'description']);
        $this->questionRepository->updateQuestion($data->question_id,  $selectedField); //calling the updateQuestion
        return redirect()->back()->with('status', 'Question updated successfully');

    }

    public function categoriesList()
    {
        return $this->questionRepository->categoriesList();   //retrieving the values of categories
    }

}

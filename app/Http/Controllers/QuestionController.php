<?php
namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    protected $questionService;

    public function __construct(QuestionService $questionService) 
    {
        $this->questionService = $questionService;
    }

    // Show categories for the ask-question form
    public function categoriesList()
    {
       
        $categories = $this->questionService->categoriesList();  // Fetching all categories with 'content_id' and 'content_name'
        return view('questions.askquestion', compact('categories')); // Pass categories to the view
    }

    public function storeQuestion(QuestionRequest $request)
    {
        $this->questionService->create($request);
        return redirect()->route('questions')->with('success', 'Question submitted successfully!');
    }

    public function show()
    {
        $questions = $this->questionService->getAllQuestion();    //using the show method from  service class
        return view('questions.questions', compact('questions')); //returning the view with question query
    }

    public function searchQuestion(Request $request)
    {
        $questions = $this->questionService->search($request->query('query')); //using the search method from service class
        return view('questions.questions', compact('questions'));
    }

    public function deleteQuestion($id)
    {
        return $this->questionService->delete($id); // Return the view with the updated questions
    }

    public function editQuestion(QuestionRequest $request)
    {
        return $this->questionService->edit($request);

    }

}

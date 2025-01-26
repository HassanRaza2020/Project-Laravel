<?php
namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Content;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    protected $questionService;

    public function __construct(QuestionService $questionService) //injecting the service class in the controller
    {
        $this->questionService = $questionService; //copy constructor

    }

    // Show categories for the ask-question form
    public function categoriesList()
    {
        // Fetching all categories with 'content_id' and 'content_name'
        $categories = $this->questionService->categoriesList();
        // Pass categories to the view
        return view('questions.askquestion', compact('categories'));

    }

    public function storeQuestion(QuestionRequest $request)
    {

        $this->questionService->create($request);

        // Redirect with success message

        return redirect()->route('questions')->with('success', 'Question submitted successfully!');

    }

    public function show()
    {

        $questions = $this->questionService->getAllQuestion(); //using the show method from  service class

        return view('questions.questions', compact('questions')); //returning the view with question query

    }

    public function searchQuestion(Request $request)
    {

        $questions = $this->questionService->search($request->query('query')); //using the search method from service class

        return view('questions.questions', compact('questions'));

    }

    public function deleteQuestion($id)
    {

        $this->questionService->delete($id);
        // Return the view with the updated questions
        return response()->noContent();
    }

    public function editQuestion(QuestionRequest $request) //edithg the questions
    {
        $data = $request->only(['title', 'description']);
        $this->questionService->update($request->question_id, $data);
        return redirect()->back()->with('status', 'Question updated successfully');

    }

}

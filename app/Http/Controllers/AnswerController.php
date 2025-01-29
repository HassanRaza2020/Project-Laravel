<?php
namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Question;
use App\Services\AnswerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\DisplayQuestionDetailsService;

class AnswerController extends Controller
{

    protected $answerService, $displayQuestionDetailsService;

    public function __construct(AnswerService $answerService , DisplayQuestionDetailsService $displayQuestionDetailsService) 
    {
        $this->answerService = $answerService; //injecting the service class in the controller
        $this->displayQuestionDetailsService = $displayQuestionDetailsService;

    }

    public function answerSubmit(AnswerRequest $request)
    {
        // Create the answer using the key as question_id          
         $this->answerService->create($request); 
        // Redirect back to the same page with a success message
        return redirect()->back()->with('success', 'Your Answer has been Submitted!');
    }

    public function showPage(Request $request)
    {
       $question = $this->displayQuestionDetailsService->displayQuestionDetails($request); //displaying question details
       $query = $this->displayQuestionDetailsService->displayAnswerList($request);  //displaying answers list
        return view("questions.main-page", compact('question','query')); //returning the view with variables

    }

    public function deleteAnswer($answerId, $questionKey)
    { //deleting the answers using question_id and answer_id

        $this->answerService->delete($answerId); //delete query using the where clause

        //Question::where('question_id', $questionKey)->select('question_id', 'title', 'Description')->first(); //selecting the columns

        $this->answerService->find($answerId); //after deleting the answer, this query will show all answers

        return redirect()->back(); //redirecting the page back the with no content

    }

    public function editAnswer(AnswerRequest $request)
    {

        $this->answerService->edit($request);
        return redirect()->back()->with('status', 'Answer updated successfully'); //returns to page with this message

    }

}

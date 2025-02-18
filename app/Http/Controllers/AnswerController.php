<?php
namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Services\AnswerService;
use App\Services\DisplayQuestionDetailsService;
use Illuminate\Http\Request;


class AnswerController extends Controller
{

    protected $answerService, $displayQuestionDetailsService;

    public function __construct(AnswerService $answerService, DisplayQuestionDetailsService $displayQuestionDetailsService)
    {
        $this->answerService = $answerService;
        $this->displayQuestionDetailsService = $displayQuestionDetailsService;
    }

    public function answerSubmit(AnswerRequest $request)
    {
        return $this->answerService->create($request);
    }

    public function showPage(Request $request)
    {
            [$question, $query] = [$this->displayQuestionDetailsService->displayQuestionDetails(decrypt($request->key)),
                                   $this->displayQuestionDetailsService->displayAnswerList(decrypt($request->key))];
        
        return view("questions.main-page", compact('question', 'query'));                               

    }

    public function deleteAnswer($answerId)
    {

        $this->answerService->delete($answerId); //delete query using the where clause
        $this->answerService->find($answerId);   //after deleting the answer, this query will show all answers
        return redirect()->back();

    }

    public function editAnswer(AnswerRequest $request)
    {
       return  $this->answerService->edit($request);
    }
}

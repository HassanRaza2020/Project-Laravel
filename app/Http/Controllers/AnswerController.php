<?php
namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Question;
use App\Services\AnswerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{

    protected $answerService;

    public function __construct(AnswerService $answerService) 
    {
        $this->answerService = $answerService; //injecting the service class in the controller

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

       $this->answerService->create($request);

    }

    public function deleteAnswer($answerId, $questionKey)
    { //deleting the answers using question_id and answer_id

        $this->answerService->delete($answerId); //delete query using the where clause

        Question::where('question_id', $questionKey)->select('question_id', 'title', 'Description')->first(); //selecting the columns

        $this->answerService->find($answerId); //after deleting the answer, this query will show all answers

        return redirect()->back(); //redirecting the page back the with no content

    }

    public function editAnswer(AnswerRequest $request)
    {

        $validator = Validator::make($request->all(), //validation form added here
            [
                'answerfield' => 'required|string|max:2000',
            ]);

        if ($validator->fails()) { //if validation fails here
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

       $this->answerService->edit($request->all());
        return redirect()->back()->with('status', 'Answer updated successfully'); //returns to page with this message

    }

}

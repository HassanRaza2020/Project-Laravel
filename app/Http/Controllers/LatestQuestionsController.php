<?php
namespace App\Http\Controllers;
use App\Services\QuestionService;
use Illuminate\Support\Facades\Log;

class LatestQuestionsController extends Controller
{

    protected $questionService;

    public function __construct(QuestionService $questionService) //injecting the service class in the controller
    {
        $this->questionService = $questionService;

    }

    public function filterQuestion()
    {
        $questions = $this->questionService->getAllQuestion(); //latest question filter by conditioniing
        $questionArray =[];  

        foreach ($questions as $question) {

            $daysDifference = \Carbon\Carbon::parse($question->created_at)->diffInDays(now());
            Log::info('Days difference: ' . $daysDifference); // Log the days difference for debugging

            if ($daysDifference <=1) {
               $questionArray = array_merge($questionArray, [$question]); //merging the array of questions
               
            } 
        }

         
        if (count($questionArray) >0) {
            return response()->json($questionArray);
        } else {
            return response()->json(['message' => 'No question has been posted within one day']);
        }
    

    }

}

<?php
namespace App\Services;

use App\Repositories\AnswerRepository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class AnswerService
{
    protected $answerRepository;

    // Constructor to inject the AnswerRepository
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    // Get all answers
    public function getAllAnswer()
    {
        return $this->answerRepository->getAllAnswer();
    }

    // Create a new answer
    public function create($data)
    {
        $this->answerRepository->createAnswer($data);
        return redirect()->back()->with('success', 'Your Answer has been Submitted!');
    }

    // Delete an answer by ID
    public function delete($id)
    {
        return $this->answerRepository->deleteAnswer($id);
    }

    // Find an answer by ID and handle decryption
    public function find($data)
    {
        try {
            $key = urldecode($data);
            $keyDecrypted = Crypt::decrypt($key); // Decrypt the key
                                                               // Fetch the answer by ID
            $query = $this->answerRepository->findAnswerById($keyDecrypted); // Return the view with the answer data
            return view('questions.main-page', compact('query'));

        } catch (DecryptException $e) {             // Redirect to the error page if decryption fails
            return redirect()->back()->with('error', 'Invalid or tampered key!');
        }
    }

    // edit an answer by ID
    public function edit($data)
    {
        $editAnswer = $this->answerRepository->edit($data->answer_id);                 //fetching the answer_id
        $editAnswer->description = $data->answerfield;                              //editing the answer
        $editAnswer->save();                                                        //saving the updated answer
        return redirect()->back()->with('status', 'Answer updated successfully');  
    }
}

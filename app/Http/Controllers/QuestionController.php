<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        // Return the questions view
        return view('questions.questions'); // Laravel will look for resources/views/questions/questions.php
    }

    public function askquestion(){
         return view('questions.askquestion');
    }

    
    public function latestquestion(){
        return view('questions.latestquestion');
   }

   public function searchquestion(){
        return view('questions.searchquestion');
   }


   



}

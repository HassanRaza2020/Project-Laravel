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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class SignupController extends Controller
{

    
    public function signup()
    {
        // Fetch questions, pass to view if needed
        return view('auth.signup'); // Make sure this view exists
    
    }



}

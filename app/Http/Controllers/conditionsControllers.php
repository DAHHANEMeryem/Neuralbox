<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class conditionsControllers extends Controller
{
    public function index()
    {
        return view('conditions'); 
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function about()
{
    return view('about');
}
    public function about2()
{
    return view('about2');
}

}

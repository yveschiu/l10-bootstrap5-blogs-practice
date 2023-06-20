<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke()
    {
        // return view('home.about');
        return 'single action controller about page';
    }
}

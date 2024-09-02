<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function protectedPage()
    {
        return view('protected-page');
    }
}

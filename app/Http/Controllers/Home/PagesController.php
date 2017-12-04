<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function root()
    {
        return view('home.pages.root');
    }
}

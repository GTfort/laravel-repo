<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    //
    public function homepage()
    {
        $myName = 'Fortune';
        return view('homepage', ['name' => $myName]);
    }

    public function aboutPage()
    {
        return view('aboutPage');
    }

    public function post()
    {
        return view('post');
    }
}

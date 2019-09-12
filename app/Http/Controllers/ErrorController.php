<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    function error404()
    {
        return view('error.404');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToderoController extends Controller
{
    public function index()
    {
        return view('Todero.home');
    }
}

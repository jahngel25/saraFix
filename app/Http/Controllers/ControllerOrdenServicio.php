<?php

namespace App\Http\Controllers;

use App\servicios;
use Illuminate\Http\Request;

class ControllerOrdenServicio extends Controller
{

    public function contratar($id)
    {
        $modelServicio = servicios::all()->where('id', '=', $id);
        $total = 0;
        foreach($modelServicio as $value)
        {
            $total = $total + $value->precio;
        }

        return view('ordenServicio', compact('modelServicio', 'total'));

    }

}

<?php

namespace App\Http\Controllers;

use App\area;
use App\servicios;
use Illuminate\Http\Request;

class PublicController extends Controller
{


    public function indexHomeWel()
    {
        $dataArea = area::all()->where('status', 1);
        return $dataArea;
    }

    public function traerServicios($id)
    {
        $dataArea = area::all()->where('status', 1)->where('id', $id)->first();
        $dataServicio = servicios::all()->where('id_area', $id);

        return view('servicios', compact('dataArea','dataServicio'));
    }
}

<?php

namespace App\Http\Controllers;

use App\area;
use App\contactenos;
use App\cotizacion;
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

    public function indexContactenos()
    {
        return view('contactenos');
    }

    public function createContactenos(Request $request)
    {
        try
        {
            $insertField =  contactenos::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'telefono' => $request['telefono'],
                'mensaje' => $request['mensaje']
            ]);
        }
        catch (\Exception $e)
        {
            dd($e);
        }

        return $this->indexContactenos();

    }

    public function createCotizacion(Request $request)
    {
        try
        {
            $insertField =  cotizacion::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'telefono' => $request['telefono'],
                'mensaje' => $request['mensaje']
            ]);
        }
        catch (\Exception $e)
        {
            dd($e);
        }

        return $this->traerServicios($request['id']);
    }
}

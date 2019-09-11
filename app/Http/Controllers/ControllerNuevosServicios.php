<?php

namespace App\Http\Controllers;

use App\area;
use App\servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ControllerNuevosServicios extends Controller
{
    public function index()
    {
        $modelServicio = servicios::query()->select((DB::raw('servicio.id, servicio.name, servicio.description, servicio.img, servicio.precio, area.name as areaName')))
                                    ->join('area', 'area.id', '=', 'servicio.id_area')
                                    ->get();

        return view('Servicios.list', compact('modelServicio'));
    }

    public function create()
    {
        $areas = area::all();
        return view('Servicios.create', compact('areas'));
    }

    public function store(Request $request)
    {
        try{
            $file = $request->file('img');
            $nombreImg = $file->getClientOriginalName();
            Storage::disk('local')->put($nombreImg,  \File::get($file));

            $insertField =  servicios::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'img' => $nombreImg,
                'precio' => $request['precio'],
                'id_area' => $request['id_area']
            ]);

        }catch (\Exception $e){

            return $e->getMessage();
        }

        return $this->index();

    }
}

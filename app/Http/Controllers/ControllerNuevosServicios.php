<?php

namespace App\Http\Controllers;

use App\area;
use App\servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Alert;

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

            Alert::success('Información creada', 'Hecho');

        }catch (\Exception $e){

            return $e->getMessage();
        }

        return $this->index();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelServicio = servicios::find($id);
        $areas = area::all();
        return view('Servicios.edit', compact('modelServicio','areas','id'));
    }

    public function update(Request $request, $id)
    {
        $modelServicio = servicios::find($id);
        if ($request->file('img'))
        {
            $file = $request->file('img');
            $nombreImg = $file->getClientOriginalName();
            Storage::disk('local')->put($nombreImg,  \File::get($file));
        }
        else
        {
            $nombreImg = $modelServicio->img;
        }

        $modelServicio->name = $request->get('name');
        $modelServicio->description = $request->get('description');
        $modelServicio->img = $nombreImg;
        $modelServicio->precio = $request->get('precio');
        $modelServicio->id_area = $request->get('id_area');
        $modelServicio->save();

        Alert::success('Información actualizada', 'Hecho');

        return $this->edit($modelServicio->id);
    }

    public function destroy($id)
    {
        $modelServicio = area::find($id);
        $modelServicio->delete();

        return redirect('/crud');
    }
}

<?php

namespace App\Http\Controllers;

use App\area;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Alert;

class ControllerArea extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelArea = area::all();
        return view('area.list', compact('modelArea'));
    }

    public function getArea()
    {
        $tasks = area::select(['id','name','description','img']);

        return Datatables::of($tasks)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('area.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $file = $request->file('img');
            $nombreImg = $file->getClientOriginalName();
            Storage::disk('local')->put($nombreImg,  \File::get($file));

            $fileInter = $request->file('img_inter');
            $nombreImgIn = $fileInter->getClientOriginalName();
            Storage::disk('local')->put($nombreImgIn,  \File::get($fileInter));

            $insertField =  area::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'img' => $nombreImg,
                'texto' => $request['texto'],
                'img_inter' => $nombreImgIn,
                'status' => 1
            ]);

            Alert::success('Información creada', 'Hecho');

        }catch (\Exception $e){

            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelArea = area::find($id);
        return view('area.edit', compact('modelArea','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $modelArea = area::find($id);
            if ($request->file('img'))
            {
                $file = $request->file('img');
                $nombreImg = $file->getClientOriginalName();
                Storage::disk('local')->put($nombreImg,  \File::get($file));
            }
            else
            {
                $nombreImg = $modelArea->img;
            }

            if ($request->file('img_inter'))
            {
                $fileInter = $request->file('img_inter');
                $nombreImgIn = $fileInter->getClientOriginalName();
                Storage::disk('local')->put($nombreImgIn,  \File::get($fileInter));
            }
            else
            {
                $nombreImgIn = $modelArea->img_inter;
            }

            $modelArea->name = $request->get('name');
            $modelArea->description = $request->get('description');
            $modelArea->img = $nombreImg;
            $modelArea->texto = $request->get('texto');
            $modelArea->img_inter = $nombreImgIn;
            $modelArea->save();

            Alert::success('Información actualizada', 'Hecho');
        }
        catch (\Exception $e)
        {
            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }

        return $this->edit($modelArea->id);
    }

}

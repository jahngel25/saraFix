<?php

namespace App\Http\Controllers;

use App\area;
use App\contactenos;
use App\cotizacion;
use App\servicios;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Alert;

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

        Alert::success('Información envia, en los proximos dias recibira respuesta al correo electronico ingresado', 'Hecho')->persistent('Cerrar');

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

        Alert::success('Información envia, en los proximos dias recibira respuesta al correo electronico ingresado', 'Hecho')->persistent('Cerrar');

        return $this->traerServicios($request['id']);
    }

    public function getDownload($name)
    {
        $file= public_path(). "/uploads/".$name;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $name, $headers);
    }

    public function getAreaApi()
    {
        $tasks = area::select(['id','name','description','img']);

        if (!$tasks)
        {
            // Se devuelve un array errors con los errores encontrados y cabecera HTTP 404.
            // En code podríamos indicar un código de error personalizado de nuestra aplicación si lo deseamos.
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un fabricante con ese código.'])],404);
        }

        return response()->json(['status'=>'ok','data'=>$tasks],200);


    }
}

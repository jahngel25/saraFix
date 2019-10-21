<?php

namespace App\Http\Controllers;

use App\relation_orden_user;
use App\servicioOrden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;

class ControllerRelationOrdenUser extends Controller
{


    public function create(Request $request)
    {
        try
        {
            $insertRelation = relation_orden_user::create([
                'id_user' => $request['id_todero'],
                'id_orden' => $request['id_orden']
            ]);

            $modelOrden = servicioOrden::find($request['id_orden']);
            $modelOrden->status = 3;
            $modelOrden->save();

            Alert::success('El servicio a sido aceptado con exito','Hecho');
        }
        catch (\Exception $e)
        {
            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }


        return redirect(route('proceso'));
    }

    public function terminarTrabajo(Request $request)
    {
        try
        {
            $modelOrden = servicioOrden::find($request['id_orden']);
            $modelOrden->status = 4;
            $modelOrden->save();

            Alert::success('El trabajo a sido terminado', 'Hecho');
        }
        catch (\Exception $e)
        {
            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }


        return redirect(route('realizados'));
    }
}

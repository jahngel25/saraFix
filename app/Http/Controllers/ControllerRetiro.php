<?php

namespace App\Http\Controllers;

use App\relation_orden_user;
use App\Retiros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use Illuminate\Support\Facades\DB;

class ControllerRetiro extends Controller
{

    public function retiros(Request $request)
    {
        try
        {
            $modelTodero = relation_orden_user::query()
                ->join('orden_servicio', 'relation_orden_user.id_orden', '=', 'orden_servicio.id')
                ->where('relation_orden_user.id_user', '=', Auth::user()->id)
                ->where('orden_servicio.status', '=',4)
                ->get();

            $ingresos =  0;

            foreach ($modelTodero as $value)
            {
                $ingresos = $ingresos + $value->total;
            }

            $descuentos = $ingresos*0.098;

            $ingresos = $ingresos-$descuentos;

            if ($ingresos > $request['cantidad'])
            {
                $insertField =  Retiros::create([
                    'cantidad' => $request['cantidad'],
                    'status' => 1,
                    'id_user' => Auth::user()->id
                ]);
                Alert::success('Solicitud de retiro exitosa, un asesor Fix-Contract se comunicara entre las proximas 24 horas', 'Hecho')->persistent('Cerrar');
            }
            else{
                Alert::info('El monto solicitado es mayor al disponible', 'Opps')->persistent('cerrar');
            }
        }
        catch (\Exception $e)
        {
            dd($e);
        }

        return redirect(route('ingresos'));
    }

    public function infoRetiros()
    {

        $modelRetiros = Retiros::query()
                                ->select(DB::raw('users.name, users.email, retiros.cantidad, retiros.id'))
                                ->join('users', 'retiros.id_user', '=', 'users.id')
                                ->where('retiros.status', 1)
                                ->get();

        return view('Administrador.solicitudRetiros', compact('modelRetiros'));

    }

    public function updateRetiro($id)
    {
        try
        {

            $modelInfo = Retiros::find($id);
            $modelInfo->status = 2;
            $modelInfo->save();

            Alert::success('Retiro realizado', 'Hecho')->persistent('Cerrar');

        }
        catch (\Exception $e)
        {
            dd($e);
        }

        return redirect(route('solicitudRetiros'));
    }

}


<?php

namespace App\Http\Controllers;

use App\calificarServicio;
use App\relation_orden_user;
use App\relation_servicio_orden;
use App\servicioOrden;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Alert;

class ClienteController extends Controller
{
    public function index()
    {
        $dataOrdenServicio = servicioOrden::query()
                            ->select(DB::raw('orden_servicio.id, orden_servicio.description, orden_servicio.date, orden_servicio.total'))
                            ->join('users', 'users.id', '=', 'orden_servicio.id_user')
                            ->where('orden_servicio.id_user', '=', Auth::user()->id)
                            ->where('status', 1)
                            ->get();

        return view('Cliente.home', compact('dataOrdenServicio'));
    }

    public function compras()
    {
        $dataOrdenServicio = servicioOrden::query()
            ->select(DB::raw('orden_servicio.id, orden_servicio.description, orden_servicio.date, orden_servicio.total, orden_servicio.status, calificacion.status AS calificar, relation_orden_user.id_user AS userAsignado'))
            ->join('users', 'users.id', '=', 'orden_servicio.id_user')
            ->leftJoin('calificacion', function ($join) {
                $join->on('orden_servicio.id', '=', 'calificacion.id_orden');
                $join->on('calificacion.type', '=', DB::raw('2'));
            })
            ->leftJoin('relation_orden_user', function ($join) {
                $join->on('orden_servicio.id', '=', 'relation_orden_user.id_orden');
            })
            ->where('orden_servicio.id_user', '=', Auth::user()->id)
            ->where('orden_servicio.status', '!=',1)
            ->get();


        return view('Cliente.compras', compact('dataOrdenServicio'));
    }

    public function informacionServicio($id)
    {
        $modelServicios = relation_servicio_orden::query()->select(DB::raw('servicio.name, servicio.precio, servicio.img, area.name AS area'))
            ->join('servicio', 'relation_servicio_orden.id_servicio','=','servicio.id')
            ->join('area','servicio.id_area','=','area.id')
            ->where('relation_servicio_orden.id_orden',$id)->get();


        return $modelServicios;
    }

    public function calificar(Request $request)
    {
        try{
            $insertField =  calificarServicio::create([
                'description' => $request['description'],
                'puntaje' => $request['puntaje'],
                'id_orden' => $request['id_orden'],
                'type' => $request['type'],
                'status' => 1
            ]);

            Alert::success('Calificación realizada', 'Gracias');
        }
        catch (\Exception $e)
        {
            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }

        return redirect(route('compras'));

    }

    public function infoUser($id)
    {
        $dataUser = User::query()->select(DB::raw('informacion_adicional.img_foto,
                                                    users.name, 
                                                    users.email, 
                                                    informacion_adicional.identificacion, 
                                                    informacion_adicional.fecha_nacimiento, 
                                                    informacion_adicional.direccion, 
                                                    informacion_adicional.transporte,
                                                    informacion_adicional.experiencia, 
                                                    informacion_adicional.perfil'))
            ->join('informacion_adicional', 'informacion_adicional.id_user','=','users.id')
            ->where('users.id',$id)
            ->first()
            ->toArray();

        $ranking = relation_orden_user::query()->join('calificacion','calificacion.id_orden','=','relation_orden_user.id_orden')
                                               ->where('id_user', '=', $id)->get();
        $data = [];
        foreach ($dataUser as $key => $value)
        {
            $data[trans('formularios.'.$key)] = $value;
        }

        $count = 0;
        $total = 0;
        foreach ($ranking as $value)
        {
            $total = $value->puntaje + $total;
            $count++;
        }

        if ($total == 0)
        {
            $rankingFinal = 5;
        }
        else{
            $rankingFinal = $total/$count;
        }

        $data['ranking'] = round($rankingFinal);

        return $data;
    }

    public function Acepted($id)
    {
        try
        {
            $modelOrden = servicioOrden::find($id);
            $modelOrden->status = 2;
            $modelOrden->save();

            Alert::success('El pago se realizo', 'Hecho');
        }
        catch (\Exception $e)
        {
            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }

        return redirect(route('homeCliente'));
    }

    public function Rejected($id)
    {
        Alert::error('El pago no se realizo', 'Error');
        return redirect(route('homeCliente'));
    }

    public function Pending($id)
    {
        Alert::info('El pago esta pendiente', 'Atencion');
        return redirect(route('homeCliente'));
    }
}

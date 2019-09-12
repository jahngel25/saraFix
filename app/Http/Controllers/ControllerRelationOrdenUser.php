<?php

namespace App\Http\Controllers;

use App\relation_orden_user;
use App\servicioOrden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerRelationOrdenUser extends Controller
{
    public function index()
    {
        $dataOrdenServicio = servicioOrden::query()
            ->select(DB::raw('orden_servicio.id, orden_servicio.date, orden_servicio.description, orden_servicio.total, users.name'))
            ->join('users', 'users.id', '=', 'orden_servicio.id_user')
            ->where('orden_servicio.status', '=', 1)->get();

        return view('Todero.home', compact('dataOrdenServicio'));
    }

    public function create(Request $request)
    {
        $insertRelation = relation_orden_user::create([
           'id_user' => $request['id_todero'],
           'id_orden' => $request['id_orden']
        ]);

        return $this->index();
    }
}

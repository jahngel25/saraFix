<?php

use App\relation_orden_user;
use App\relationTypeUsers;
use App\Retiros;
use Illuminate\Support\Facades\Auth;


/**
 *
 */
function roleUser()
{
    $userType = relationTypeUsers::query()->where('id_user', Auth::user()->id)->first();
    return $userType->id_type;
}

function statusUser()
{
    $userType = relationTypeUsers::query()->where('id_user', Auth::user()->id)->first();
    return $userType->status;
}

function totalIngresos($id)
{
    $modelTodero = relation_orden_user::query()
        ->join('orden_servicio', 'relation_orden_user.id_orden', '=', 'orden_servicio.id')
        ->where('relation_orden_user.id_user', '=', $id)
        ->where('orden_servicio.status', '=',4)
        ->get();

    $ingresos =  0;
    foreach ($modelTodero as $value)
    {
        $ingresos = $ingresos + $value->total;
    }

    $descuentos = $ingresos*0.098;
    $ingresos = $ingresos-$descuentos;
    $modelRetiros = Retiros::query()->where('status', '=', 2)
        ->where('id_user', '=', $id)->get();
    foreach ($modelRetiros as $value)
    {
        $ingresos = $ingresos-$value->cantidad;
    }

    return $ingresos;
}


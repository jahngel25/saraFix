<?php

namespace App\Http\Controllers;

use App\servicioOrden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToderoController extends Controller
{
    public function index()
    {
        $dataOrdenServicio = servicioOrden::query()
            ->join('users', 'users.id', '=', 'orden_servicio.id_user')
            ->where('orden_servicio.status', '=', 1)->get();

        return view('Todero.home', compact('dataOrdenServicio'));
    }
}

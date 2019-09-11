<?php

namespace App\Http\Controllers;

use App\servicioOrden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {
        $dataOrdenServicio = servicioOrden::query()
                            ->join('users', 'users.id', '=', 'orden_servicio.id_user')
                            ->where('orden_servicio.id_user', '=', Auth::user()->id)->get();

        return view('Cliente.home', compact('dataOrdenServicio'));
    }
}

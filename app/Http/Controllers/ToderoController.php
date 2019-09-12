<?php

namespace App\Http\Controllers;

use App\relationTypeUsers;
use App\servicioOrden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ToderoController extends Controller
{
    public function index()
    {
        if (statusUser() == 1)
        {
            $dataOrdenServicio = servicioOrden::query()
                ->select(DB::raw('orden_servicio.id, orden_servicio.date, orden_servicio.description, orden_servicio.total, users.name'))
                ->join('users', 'users.id', '=', 'orden_servicio.id_user')
                ->where('orden_servicio.status', '=', 1)->get();

            return view('Todero.home', compact('dataOrdenServicio'));
        }
        else
        {
            return $this->indexInformation();
        }

    }

    public function indexInformation()
    {
        return view('Todero.information');
    }
}

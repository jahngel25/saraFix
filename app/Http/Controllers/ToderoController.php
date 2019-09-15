<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Departamento;
use App\Pais;
use App\relationTypeUsers;
use App\servicioOrden;
use App\tipoDocumento;
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
        $dataPais = Pais::all();
        $dataTipoDocumento = tipoDocumento::all();
        return view('Todero.information', compact('dataPais', 'dataTipoDocumento'));
    }

    public function createInformacionAdicional(Request $request)
    {
        dd($request, $request->file());
    }

    public function traerDepartamento($id)
    {
        $modelDepartamento = Departamento::all()->where('id_pais', $id);

        return $modelDepartamento;
    }

    public function traerCiudad($id)
    {
        $modelCiudad = Ciudad::all()->where('id_departamento', $id);

        return $modelCiudad;
    }

}

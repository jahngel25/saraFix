<?php

namespace App\Http\Controllers;

use App\contactenos;
use App\cotizacion;
use App\informacionAdicional;
use App\relationTypeUsers;
use App\User;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index()
    {
        return view('Administrador.home');
    }

    public function indexUsuarioConstrutor()
    {
        $modelUser = relationTypeUsers::query()->where('id_type',1)
                                        ->join('users', 'relation_typeuser.id_user','=','users.id')
                                        ->get();

        return view('Administrador.usuarioConstructor', compact('modelUser'));
    }

    public function indexUsuarioCliente()
    {
        $modelUser = relationTypeUsers::query()->where('id_type',2)
            ->join('users', 'relation_typeuser.id_user','=','users.id')
            ->get();

        return view('Administrador.usuarioCliente', compact('modelUser'));
    }

    public function informacionAdicional($id)
    {
        $modelInformacionAdi = informacionAdicional::query()
                                                     ->where('informacion_adicional.id_user', '=', $id)
                                                     ->join('ciudad', 'ciudad.id', '=','informacion_adicional.ciudad')
                                                     ->join('departamento', 'departamento.id','=','ciudad.id_departamento')
                                                     ->join('pais', 'pais.id','=','departamento.id_pais')
                                                     ->join('tipo_documneto', 'tipo_documneto.id','=','informacion_adicional.id_tipo_documento')
                                                     ->first();

        return $modelInformacionAdi;
    }

    public function indexContactenos()
    {
        $modelContactenos = contactenos::query()->get();

        return view('Administrador.contactenos', compact('modelContactenos'));
    }

    public function indexCotizaciones()
    {
        $modelCotizacion = cotizacion::query()->get();

        return view('Administrador.cotizacion', compact('modelCotizacion'));
    }
}

<?php

namespace App\Http\Controllers;

use App\contactenos;
use App\cotizacion;
use App\informacionAdicional;
use App\Mail\ContactenosEmail;
use App\Mail\CotizacionEmail;
use App\relation_orden_user;
use App\relationTypeUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Alert;
use Illuminate\Support\Facades\Response;

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

    public function emailContactenos(Request $request)
    {
        Mail::to($request->get('email'))
              ->send(new ContactenosEmail($request));
        Alert::success('Email enviado', 'Hecho');

        return $this->indexContactenos();
    }

    public function emailCotizacion(Request $request)
    {
        Mail::to($request->get('email'))
            ->send(new CotizacionEmail($request));

        Alert::success('Email enviado', 'Hecho');
        return $this->indexContactenos();
    }

    public function updateEstado($id)
    {
        $modelUser = relationTypeUsers::where('id_user', $id)->first();
        $modelUser->status = 1;
        $modelUser->save();

        Alert::success('Usuario Aceptado', 'Hecho');
        return $this->indexUsuarioConstrutor();
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
                                                    informacion_adicional.documento_doc,  
                                                    informacion_adicional.certificado_doc, 
                                                    informacion_adicional.bachiller_doc, 
                                                    informacion_adicional.eps_doc, 
                                                    informacion_adicional.experiencia, 
                                                    informacion_adicional.perfil'))
                             ->join('informacion_adicional', 'informacion_adicional.id_user','=','users.id')
                             ->where('users.id',$id)
                             ->first()
                             ->toArray();

        $data = [];
        foreach ($dataUser as $key => $value)
        {
            $data[trans('formularios.'.$key)] = $value;
        }

        $data['ingresos'] = totalIngresos($id);
        return $data;
    }

    public function getDownload($name)
    {
        $file= public_path(). "/uploads/".$name;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $name, $headers);
    }

    public function infoServicio()
    {
        $modelServicio = relation_orden_user::query()
                                                ->select(DB::raw('orden_servicio.id, usp.name AS userProfesional, usc.name AS userCliente, orden_servicio.date, cap.puntaje AS puntajeProfesional, cac.puntaje AS puntajeCliente'))
                                                ->join('orden_servicio', 'relation_orden_user.id_orden', '=', 'orden_servicio.id')
                                                ->join('users AS usp', 'relation_orden_user.id_user', '=', 'usp.id')
                                                ->join('users AS usc', 'orden_servicio.id_user', '=', 'usc.id')
                                                ->leftJoin('calificacion AS cap', function ($join) {
                                                    $join->on('orden_servicio.id', '=', 'cap.id_orden');
                                                    $join->on('cap.type', '=', DB::raw(2));
                                                })
                                                ->leftJoin('calificacion AS cac', function ($join) {
                                                    $join->on('orden_servicio.id', '=', 'cac.id_orden');
                                                    $join->on('cac.type', '=', DB::raw(1));
                                                })
                                                ->get();


        return view('Administrador.infoServicios', compact('modelServicio'));
    }
}

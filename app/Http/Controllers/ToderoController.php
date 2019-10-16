<?php

namespace App\Http\Controllers;

use App\calificarServicio;
use App\Ciudad;
use App\Departamento;
use App\informacionAdicional;
use App\Pais;
use App\relation_servicio_orden;
use App\relationTypeUsers;
use App\servicioOrden;
use App\servicios;
use App\tipoDocumento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Alert;

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
        $estado = relationTypeUsers::where('id_user', Auth::user()->id)->first();
        if ($estado->status == 3)
        {
            $dataTodero = informacionAdicional::query()->where('id_user', '=', Auth::user()->id)->first();
        }
        else
        {
            $dataTodero = "";
        }

        return view('Todero.information', compact('dataPais', 'dataTipoDocumento', 'dataTodero'));
    }

    public function createInformacionAdicional(Request $request)
    {
        try
        {
            $insertField =  informacionAdicional::create([
                'identificacion' => $request['identificacion'],
                'fecha_nacimiento' => $request['fecha_nacimiento'],
                'direccion' => $request['direccion'],
                'transporte' => $request['transporte'],
                'experiencia' => $request['experiencia'],
                'perfil' => $request['perfil'],
                'id_user' => Auth::user()->id,
                'id_tipo_documento' => $request['id_tipo_documento'],
                'id_ciudad' => $request['id_ciudad']
            ]);

            if ($request->file('img_foto'))
            {
                $fileFoto = $request->file('img_foto');
                $nombreFoto = $insertField->id.'_foto_'.$fileFoto->getClientOriginalName();
                Storage::disk('local')->put($nombreFoto,  \File::get($fileFoto));

            }
            else{
                $nombreFoto = '';
            }

            if ($request->file('documento_doc'))
            {
                $fileDocumento = $request->file('documento_doc');
                $nombreDocumento = $insertField->id.'_documento_'.$fileDocumento->getClientOriginalName();
                Storage::disk('local')->put($nombreDocumento,  \File::get($fileDocumento));


            }
            else{
                $nombreDocumento = '';
            }

            if ($request->file('documento_doc'))
            {
                $fileCertificado = $request->file('certificado_doc');
                $nombreCertificado = $insertField->id.'_certificado_'.$fileCertificado->getClientOriginalName();
                Storage::disk('local')->put($nombreCertificado,  \File::get($fileCertificado));

            }
            else{
                $nombreCertificado = '';
            }

            if ($request->file('documento_doc'))
            {
                $fileBachiller = $request->file('bachiller_doc');
                $nombreBachiller = $insertField->id.'_bachiller_'.$fileBachiller->getClientOriginalName();
                Storage::disk('local')->put($nombreBachiller,  \File::get($fileBachiller));

            }
            else{
                $nombreBachiller = '';
            }

            if ($request->file('documento_doc'))
            {
                $fileEps = $request->file('eps_doc');
                $nombreEps = $insertField->id.'_'.$fileEps->getClientOriginalName();
                Storage::disk('local')->put($nombreEps,  \File::get($fileEps));

            }
            else{
                $nombreEps = '';
            }

            $modelInfo = informacionAdicional::find($insertField->id);
            $modelInfo->identificacion = $request['identificacion'];
            $modelInfo->fecha_nacimiento = $request['fecha_nacimiento'];
            $modelInfo->direccion = $request['direccion'];
            $modelInfo->transporte = $request['transporte'];
            $modelInfo->experiencia = $request['experiencia'];
            $modelInfo->perfil = $request['perfil'];
            $modelInfo->id_user = Auth::user()->id;
            $modelInfo->id_tipo_documento = $request['id_tipo_documento'];
            $modelInfo->id_ciudad = $request['id_ciudad'];
            $modelInfo->img_foto = $nombreFoto;
            $modelInfo->documento_doc = $nombreDocumento;
            $modelInfo->certificado_doc = $nombreCertificado;
            $modelInfo->bachiller_doc = $nombreBachiller;
            $modelInfo->eps_doc = $nombreEps;
            $modelInfo->save();

            $modelUser = relationTypeUsers::where('id_user', Auth::user()->id)->first();
            $modelUser->status = 3;
            $modelUser->save();

            Alert::success('La informacioón sera validad por un usuario de Fix-Contract para poder empezar a trabajar con nosotros','Registro terminado')->persistent("Cerrar");

        }catch (\Exception $e)
        {
            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }

        return redirect()->route('homeTodero');
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

    public function informacionServicio($id)
    {
        $modelServicios = relation_servicio_orden::query()->select(DB::raw('servicio.name, servicio.precio, servicio.img, area.name AS area'))
                                            ->join('servicio', 'relation_servicio_orden.id_servicio','=','servicio.id')
                                            ->join('area','servicio.id_area','=','area.id')
                                            ->where('relation_servicio_orden.id_orden',$id)->get();
        return $modelServicios;
    }

    public function trabajosProceso()
    {
        $dataOrdenServicio = servicioOrden::query()
            ->select(DB::raw('orden_servicio.id, orden_servicio.date, orden_servicio.description, orden_servicio.total, users.name'))
            ->join('users', 'users.id', '=', 'orden_servicio.id_user')
            ->join('relation_orden_user', function ($join) {
                $join->on('orden_servicio.id', '=', 'relation_orden_user.id_orden');
                $join->on('relation_orden_user.id_user', '=', DB::raw(Auth::user()->id));
            })
            ->where('orden_servicio.status', '=', 2)->get();


        return view('Todero.proceso', compact('dataOrdenServicio'));
    }

    public function trabajosRealizados()
    {
        $dataOrdenServicio = servicioOrden::query()
            ->select(DB::raw('orden_servicio.id, orden_servicio.date, orden_servicio.description, orden_servicio.total, users.name, calificacion.status AS calificar'))
            ->join('users', 'users.id', '=', 'orden_servicio.id_user')
            ->leftJoin('calificacion', function ($join) {
                $join->on('orden_servicio.id', '=', 'calificacion.id_orden');
                $join->on('calificacion.type', '=', DB::raw('1'));
            })
            ->join('relation_orden_user', function ($join) {
                $join->on('orden_servicio.id', '=', 'relation_orden_user.id_orden');
                $join->on('relation_orden_user.id_user', '=', DB::raw(Auth::user()->id));
            })
            ->where('orden_servicio.status', '=', 3)->get();


        return view('Todero.realizados', compact('dataOrdenServicio'));
    }

    public function terminarTrabajo(Request $request)
    {
        try
        {
            $modelOrden = servicioOrden::find($request['id_orden']);
            $modelOrden->status = 3;
            $modelOrden->save();

            Alert::success('El trabajo a sido terminado', 'Hecho');
        }
        catch (\Exception $e)
        {
            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }


        return redirect(route('realizados'));
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

        return redirect(route('realizados'));

    }

}

<?php

namespace App\Http\Controllers;

use App\area;
use App\calificarServicio;
use App\Ciudad;
use App\Departamento;
use App\informacionAdicional;
use App\Pais;
use App\relation_orden_user;
use App\relation_servicio_orden;
use App\relation_user_area;
use App\relationTypeUsers;
use App\Retiros;
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
            $modelAreaUser = relation_user_area::query()->select('id_area')
                                                        ->where('id_user', Auth::user()->id)
                                                        ->pluck('id_area')->toArray();


            $dataOrdenServicio = servicioOrden::query()
                ->select(DB::raw('orden_servicio.id, orden_servicio.date, orden_servicio.description, orden_servicio.total, users.name'))
                ->join('users', 'users.id', '=', 'orden_servicio.id_user')
                ->join('relation_servicio_orden', 'orden_servicio.id','=', 'relation_servicio_orden.id_orden')
                ->join('servicio', 'relation_servicio_orden.id_servicio', '=', 'servicio.id')
                ->join('relation_user_area', 'relation_user_area.id_user', '=', DB::raw(Auth::user()->id))
                ->where('orden_servicio.status', '=', 2)
                ->whereIn('servicio.id_area', $modelAreaUser)
                ->groupBy('orden_servicio.id','orden_servicio.date', 'orden_servicio.description', 'orden_servicio.total', 'users.name')
                ->get();

            return view('Todero.home', compact('dataOrdenServicio'));
        }
        else
        {

            return $this->indexInformation();
        }

    }

    public function indexInformation()
    {
        $dataDepartamento = Departamento::all();
        $dataCiudad = Ciudad::all();
        $dataPais = Pais::all();
        $dataTipoDocumento = tipoDocumento::all();
        $estado = relationTypeUsers::where('id_user', Auth::user()->id)->first();
        $modelAreas = area::query()->select('id', 'name')->get();
        if ($estado->status == 3)
        {
            $dataTodero = informacionAdicional::query()
                                                ->select(DB::raw('informacion_adicional.*, informacion_adicional.id, departamento.id_pais, ciudad.id_departamento'))
                                                ->join('ciudad', 'informacion_adicional.id_ciudad', '=', 'ciudad.id')
                                                ->join('departamento', 'ciudad.id_departamento', '=', 'departamento.id')
                                                ->join('pais', 'departamento.id_pais', '=', 'pais.id')
                                                ->where('id_user', '=', Auth::user()->id)
                                                ->first();

            $dataAreas = relation_user_area::query()->select('id_area')->where('id_user', Auth::user()->id)->get();
        }
        else
        {
            $dataTodero = "";
            $dataAreas = "";
        }

        return view('Todero.information', compact('dataPais', 'dataTipoDocumento', 'dataTodero', 'modelAreas', 'dataAreas', 'dataDepartamento', 'dataCiudad'));
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

            foreach ($request['id_area'] as $value)
            {
                   $insertFielArea = relation_user_area::create([
                       'id_user' => Auth::user()->id,
                       'id_area' => $value
                   ]);
            }

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
            ->where('orden_servicio.status', '=', 3)->get();


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
            ->where('orden_servicio.status', '=', 4)->get();


        return view('Todero.realizados', compact('dataOrdenServicio'));
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

    public function ingresos()
    {
        $ingresos =  totalIngresos(Auth::user()->id);
        return view('Todero.ingresos', compact('ingresos'));
    }

    public function editInformacionAdicional(Request $request)
    {
        try
        {
            $modelInfoAdicinal = informacionAdicional::query()->where('id', '=', $request['id'])->first();
            $updateField = informacionAdicional::find($request['id']);
            $updateField->identificacion = $request['identificacion'];
            $updateField->fecha_nacimiento = $request['fecha_nacimiento'];
            $updateField->direccion = $request['direccion'];
            $updateField->transporte = $request['transporte'];
            $updateField->experiencia = $request['experiencia'];
            $updateField->perfil = $request['perfil'];
            $updateField->id_tipo_documento = $request['id_tipo_documento'];
            $updateField->id_ciudad = $request['id_ciudad'];
            $updateField->save();

            foreach ($request['id_area'] as $value)
            {
                $insertFielArea = relation_user_area::create([
                    'id_user' => Auth::user()->id,
                    'id_area' => $value
                ]);
            }

            if ($request->file('img_foto'))
            {
                $fileFoto = $request->file('img_foto');
                $nombreFoto = $request['id'].'_foto_'.$fileFoto->getClientOriginalName();
                Storage::disk('local')->put($nombreFoto,  \File::get($fileFoto));

            }
            else{
                $nombreFoto = $modelInfoAdicinal->img_foto;
            }

            if ($request->file('documento_doc'))
            {
                $fileDocumento = $request->file('documento_doc');
                $nombreDocumento = $request['id'].'_documento_'.$fileDocumento->getClientOriginalName();
                Storage::disk('local')->put($nombreDocumento,  \File::get($fileDocumento));


            }
            else{
                $nombreDocumento = $modelInfoAdicinal->documento_doc;
            }

            if ($request->file('documento_doc'))
            {
                $fileCertificado = $request->file('certificado_doc');
                $nombreCertificado = $request['id'].'_certificado_'.$fileCertificado->getClientOriginalName();
                Storage::disk('local')->put($nombreCertificado,  \File::get($fileCertificado));

            }
            else{
                $nombreCertificado = $modelInfoAdicinal->documento_doc;
            }

            if ($request->file('bachiller_doc'))
            {
                $fileBachiller = $request->file('bachiller_doc');
                $nombreBachiller = $request['id'].'_bachiller_'.$fileBachiller->getClientOriginalName();
                Storage::disk('local')->put($nombreBachiller,  \File::get($fileBachiller));

            }
            else{
                $nombreBachiller = $modelInfoAdicinal->bachiller_doc;
            }

            if ($request->file('eps_doc'))
            {
                $fileEps = $request->file('eps_doc');
                $nombreEps = $request['id'].'_'.$fileEps->getClientOriginalName();
                Storage::disk('local')->put($nombreEps,  \File::get($fileEps));

            }
            else{
                $nombreEps = $modelInfoAdicinal->eps_doc;
            }

            $modelInfo = informacionAdicional::find($request['id']);
            $modelInfo->img_foto = $nombreFoto;
            $modelInfo->documento_doc = $nombreDocumento;
            $modelInfo->certificado_doc = $nombreCertificado;
            $modelInfo->bachiller_doc = $nombreBachiller;
            $modelInfo->eps_doc = $nombreEps;
            $modelInfo->save();

            Alert::success('La información editada','Registro terminado')->persistent("Cerrar");

        }catch (\Exception $e)
        {
            dd($e);
            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }

        return redirect()->route('homeTodero');
    }

    public function editPerfil()
    {
        $dataDepartamento = Departamento::all();
        $dataCiudad = Ciudad::all();
        $dataPais = Pais::all();
        $dataTipoDocumento = tipoDocumento::all();
        $modelAreas = area::query()->select('id', 'name')->get();

        $dataTodero = informacionAdicional::query()
            ->select(DB::raw('informacion_adicional.*, informacion_adicional.id, departamento.id_pais, ciudad.id_departamento'))
            ->join('ciudad', 'informacion_adicional.id_ciudad', '=', 'ciudad.id')
            ->join('departamento', 'ciudad.id_departamento', '=', 'departamento.id')
            ->join('pais', 'departamento.id_pais', '=', 'pais.id')
            ->where('id_user', '=', Auth::user()->id)
            ->first();

        $dataAreas = relation_user_area::query()->select('id_area')->where('id_user', Auth::user()->id)->get();

        return view('Todero.edit', compact('dataPais', 'dataTipoDocumento', 'dataTodero', 'modelAreas', 'dataAreas','dataDepartamento','dataCiudad'));

    }

}

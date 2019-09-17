<?php

namespace App\Http\Controllers;

use App\Ciudad;
use App\Departamento;
use App\informacionAdicional;
use App\Pais;
use App\relationTypeUsers;
use App\servicioOrden;
use App\tipoDocumento;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $modelUser->status = 1;
            $modelUser->save();

        }catch (\Exception $e)
        {
            return $e;
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

}

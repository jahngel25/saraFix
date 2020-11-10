<?php

namespace App\Http\Controllers;

use App\codigoPromocional;
use App\ordenDeServicio;
use App\relation_servicio_orden;
use App\servicioOrden;
use App\servicios;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie as CookieAlias;
use Alert;
use Illuminate\Support\Facades\Validator;

class ControllerOrdenServicio extends Controller
{

    public function contratar($id, $guid, $id_area)
    {
        try{

            $modelServicio = '';

            if ($guid != session()->get('guidData'))
            {
                session()->put('guidData',$guid);

                if (session()->get('ServiciosContratar') == null)
                {
                    session()->put('ServiciosContratar',$id);
                }
                else
                {
                    $ids = session()->get('ServiciosContratar');
                    $ids = $ids.','.$id;
                    session()->put('ServiciosContratar',$ids);
                }
            }
            $condicion = explode(',', session()->get('ServiciosContratar'));
            if($condicion != '')
            {
                foreach ($condicion as $value)
                {
                    if ($modelServicio  == "")
                    {
                        $modelServicio = servicios::query()->where('id', $value)->get()->toArray();
                    }
                    else
                    {
                        $modelServicio  = array_merge($modelServicio, servicios::all()->where('id', $value)->toArray());
                    }
                }

                $total = 0;
                foreach($modelServicio as $value)
                {
                    $total = $total + $value['precio'];
                }
            }
            else{
                $total = 0;
            }
        }
        catch (\Exception $e)
        {
            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }


        return view('ordenServicio', compact('modelServicio', 'total', 'id_area', 'id', 'guid'));

    }

    public function crear(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [
                'description' => 'required',
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'telefono' => 'required',
                'date' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect(route('ordenServicio', ['12', '5da8e4cf941f9', '2']))
                    ->withErrors($validator)
                    ->withInput();
            }

            $dataUser = User::query()->where('email', '=', $request['email'])->first();
            if (isset($dataUser->email))
            {
                $idUser = $dataUser->id;
            }
            else
            {
                $insertField =  User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => bcrypt($request['telefono']),
                ]);
                $typeUser = new ControllerRelationUserType();
                $typeUser->create($insertField->id, 2,1);
                $idUser = $insertField->id;
            }

            $modelCodigo = codigoPromocional::query()->where('codigo', $request['id_codigo'])->get()->toArray();

            $insertOrden = servicioOrden::create([
                'description' => $request['description'],
                'total' => $request['total'],
                'id_codigo' => 1,
                'id_user' => $idUser,
                'address' => $request['address'],
                'telefono' => $request['telefono'],
                'date' => $request['date'],
            ]);

            $total = 0;

            foreach ($request['servicios'] as $value)
            {
                $servicio = servicios::query()->where('id', $value)->first();
                $total = $total + $servicio->precio;
                $insertRelations = relation_servicio_orden::create([
                   'id_orden' =>  $insertOrden->id,
                    'id_servicio' => $value
                ]);
            }

            if (isset($modelCodigo))
            {
                $total = $total - 5000;
            }

            $updateTotal = servicioOrden::find($insertOrden->id);
            $updateTotal->total = $total;
            $updateTotal->save();

            Alert::success('Se ha registrado su orden de servicio, si posee usuario en la aplicación el servicio queda asociado a su correo electronico de lo contrario en aplicativo le asignara uno apartir del correo ingresado y su contraseña sera el numero de telefono. Por favor ingresar para terminar el proceso de contratación.', 'Hecho')->persistent('Cerrar');

            session()->put('ServiciosContratar','');

        }
        catch (\Exception $e){

            Alert::error('Ocurrio un incoveniente durante el proceso','Opps');
        }

        return redirect(route('/'));

    }

    public function delete($key, $id, $guid, $area)
    {
        $condicion = explode(',', session()->get('ServiciosContratar'));
        unset($condicion[$key]);
        $stringVar = implode(',', $condicion);

        session()->put('ServiciosContratar', $stringVar);
        return redirect(route('ordenServicio', [$id, $guid, $area]));
    }

}

<?php

namespace App\Http\Controllers;

use App\ordenDeServicio;
use App\relation_servicio_orden;
use App\servicioOrden;
use App\servicios;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie as CookieAlias;
use Alert;

class ControllerOrdenServicio extends Controller
{

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contratar($id)
    {
        try{
            $total = 0;
           $modelServicio = '';
            if (isset($id))
            {

                if (Cache::get('ServiciosContratar') == null)
                {
                    Cache::put('ServiciosContratar',$id, 90);
                }
                else
                {
                    $ids = Cache::get('ServiciosContratar');
                    $ids = $ids.','.$id;
                    Cache::put('ServiciosContratar',$ids, 90);
                }

                $condicion = explode(',', Cache::get('ServiciosContratar'));
                $modelServicio = servicios::all()->whereIn('id', $condicion);
                foreach($modelServicio as $value)
                {
                    $total = $total + $value->precio;
                }
            }
        }
        catch (\Exception $e){
            return $e;
        }

        return view('ordenServicio', compact('modelServicio', 'total'));

    }

    public function crear(Request $request)
    {
        try{

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
                $typeUser->create($insertField->id, 2);
                $idUser = $insertField->id;
            }


            $insertOrden = servicioOrden::create([
                'description' => $request['description'],
                'total' => $request['total'],
                'id_codigo' => 1,
                'id_user' => $idUser,
                'address' => $request['address'],
                'telefono' => $request['telefono'],
                'date' => $request['date'],
            ]);

            foreach ($request['servicios'] as $value)
            {
                $insertRelations = relation_servicio_orden::create([
                   'id_orden' =>  $insertOrden->id,
                    'id_servicio' => $value
                ]);
            }

            Cache::put('ServiciosContratar','', 1);

        }
        catch (\Exception $e){
            return $e;
        }

        return view('welcome');

    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ControllerRelationUserType;
use App\relationTypeUsers;
use App\typeUsers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     *
     */
    public function registerProvider()
    {
        $userType = typeUsers::all()->where('id', '=', 1);
        return view('auth.registerProvider', compact('userType'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ($data['type_user'] == 1){
            $status = 2;
        }else{
            $status = 1;
        }

        $insertField =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if (isset($data['type_user']))
        {
            $typeUser = new ControllerRelationUserType();
            $typeUser->create($insertField->id, $data['type_user'], $status);
        }

        Alert::success('Registro realizado')->persistent("Cerrar");

        return $insertField;

    }

    public function redirectPath()
    {
        if(roleUser() == 1){
            return  '/Todero/home';
        }
        else if(roleUser() == 2){
            return  '/Cliente/home';
        }
        else if(roleUser() == 3){
            return  '/Administrador/home';
        }

        if (method_exists($this, 'redirectTo'))
        {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}

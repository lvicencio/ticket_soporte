<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Proyect;
use App\ProyectUser;

class UserController extends Controller
{
    public function index()
    {

      //$users = User::all(); <--- envia todos los usuarios del sistema
      $users = User::where('role',1)->get(); //envia todos los users de soporte
      return view('admin.users.index')->with(compact('users'));
    }

    public function buscador(Request $request)
    {
      //$users = User::all();
      $name = $request -> input('name');
      $users = User::Buscador($name)->get();
      return view('admin.users.config')->with(compact('users'));
    }

    public function store(Request $request)
    {
      $rules=[
        'name'      => 'required|max:255',
        'email'     => 'required|email|max:255|unique:users',
        'password'  => 'required|min:6'
      ];
      $messages=[
        'name.required'  =>'Ingrese Nombre del Usuario',
        'name.max'      =>'El nombre es demasiado largo',
        'email.required' =>'El Correo es obligatorio',
        'email.max'     =>'El correo es demasiado largo',
        'email.unique'  =>'Este Correo ya se encuentra registrado',
        'password.required'=>'Ingrese su Contraseña',
        'password.min'  =>'La contraseña debe tener minimo 6 caracteres'
      ];

      $this->validate($request,$rules,$messages);

      $user = new User();
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = bcrypt($request->input('password'));
      $user->role = 1;

      $user->save();
      //dd($request->all());
      return back()->with('notification', 'usuario registrado de manera correcta');
    }

    public function edit($id)
    {
      $user = User::find($id);
      $projects = Proyect::all();
      $proyects_user = ProyectUser::where('user_id', $user->id)->get();
      return view('admin.users.edit')->with(compact('user','projects','proyects_user'));
    }
    public function update($id, Request $request)
    {

      $rules=[
        'name'      => 'required|max:255',
        'email'     => 'required|email|max:255',
        'password'  => 'min:6'
      ];
      $messages=[
        'name.required'  =>'Ingrese Nombre del Usuario',
        'name.max'      =>'El nombre es demasiado largo',
        'email.required' =>'El Correo es obligatorio',
        'email.max'     =>'El correo es demasiado largo',
        'password.min'  =>'La contraseña debe tener minimo 6 caracteres'
      ];
      $this->validate($request,$rules,$messages);

      $user = User::find($id);
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->role = $request->input('role');
      $password = $request->input('password');
      // si esta ingresada una nueva contraseña, hacer lo sgte
      if ($password) {
        $user->password= bcrypt($password);
      }
      $user->save();

      return back()->with('notification', 'usuario Editado de manera correcta');
    }

    public function delete($id)
    {
      $user = User::find($id);
      $user ->delete();

      return back()->with('notification', 'El Usuario se ha Eliminado');
    }
}

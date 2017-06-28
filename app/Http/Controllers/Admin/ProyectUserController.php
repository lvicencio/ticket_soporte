<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProyectUser;

class ProyectUserController extends Controller
{
    public function store(Request $request)
    {
      $proyect_id               = $request->input('proyect_id');
      $user_id                  = $request->input('user_id');
      //valida si ya esta asignado al proyecto
      $proyect_user             = ProyectUser::where('proyect_id', $proyect_id)
                                        ->where('user_id', $user_id)->first();
      if ($proyect_user) {
        return back()->with('notification', 'El Usuario ya pertenece a este Proyecto');
      }
      $proyect_user             = new ProyectUser();
      $proyect_user->proyect_id = $proyect_id;
      $proyect_user->user_id    = $user_id;
      $proyect_user->level_id   = $request->input('level_id');
      //dd($request->all());
      $proyect_user->save();

      return back();
    }

    public function delete($id)
    {
      ProyectUser::find($id)->delete();
      return back()->with('notification', 'El Usuario ya no pertenece al proyecto');
    }
}

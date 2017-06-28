<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\ProyectUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $selected_proyect_id = $user->selected_proyect_id;

        if ($user->is_support) {
          $my_incidents = Incident::where('proyect_id', $selected_proyect_id)
                                  ->where('support_id', $user->id)->get();

          $proyectUser = ProyectUser::where('proyect_id', $selected_proyect_id)
                                  ->where('user_id', $user->id)->first();


          $incident_pendientes = Incident::where('support_id', null)
                                  ->where('level_id', $proyectUser->level_id)->get();

          
        }



        $mis_incidencias = Incident::where('client_id', $user->id)
                                ->where('proyect_id', $selected_proyect_id)->get();

        return view('home')->with(compact('my_incidents','incident_pendientes','mis_incidencias'));
    }

    public function selectProject($id)
    {
      $user = auth()->user();
      $user->selected_proyect_id = $id;
      $user->save();

      return back();
    }


}

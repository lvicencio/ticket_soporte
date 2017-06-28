<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proyect;

class ProjectController extends Controller
{
  public function index()
  {
    //withTrashed muestra todos los proyectos (incluso los borrados con softdelete)
    $projects = Proyect::withTrashed()->get();
    return view('admin.projects.index')->with(compact('projects'));
  }
  public function store(Request $request)
  {
   // las reglas de validacion rules y messages estan definidas en el modelo Proyect
    $this->validate($request, Proyect::$rules, Proyect::$messages);
    Proyect::create($request->all());

    return back()->with('notification', 'El Proyecto se registro de manera correcta');
  }
  public function edit($id)
  {
    $project = Proyect::find($id);
    $categories = $project->categories;
    $levels = $project->levels; //Level::where('proyect_id',$id)->get();
    return view('admin.projects.edit')->with(compact('project','categories','levels'));
  }
  public function update($id, Request $request)
  {
    // las reglas de validacion rules y messages estan definidas en el modelo Proyect
     $this->validate($request, Proyect::$rules, Proyect::$messages);

     Proyect::find($id)->update($request->all());
     return back()->with('notification', 'El Proyecto se Edito correctamente');
  }

  public function delete($id)
  {
    Proyect::find($id)->delete();

    return back()->with('notification', 'El Proyecto se deshabilito correctamente');
  }

  public function restore($id)
  {
    Proyect::withTrashed()->find($id)->restore();

    return back()->with('notification', 'El Proyecto fue Habilitado');
  }
}

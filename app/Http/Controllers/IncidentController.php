<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\Proyect;
use App\ProyectUser;

class IncidentController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function create()
  {
      $categories = Category::where('proyect_id', 1)->get();
      return view('incidents.create')->with(compact('categories'));
  }

public function todos(Request $request)
  {
     //$incidents  = Incident::all();
     //return view('admin.incidents.show')->with(compact('incidents'));
     $name = $request -> input('name');
     $incidents = Incident::Buscador($name)->get();
     return view('admin.incidents.show')->with(compact('incidents'));
  }





  public function show($id)
  {
     $incident  = Incident::findOrFail($id);
     $messages  = $incident->messages;
     return view('incidents.show')->with(compact('incident','messages'));
  }

  public function store(Request $request)
  {
    //validaciones
    $rules = [
      'category_id' => 'sometimes|exists:categories,id', //exists:categories,id verifica si el id en el tabla categories existe
      'severity' => 'required|in:M,N,A',
      'title' => 'required|min:5',
      'description' => 'required|min:15'
    ];
    $messages =[
      'category_id.exists'  =>'Categoria no Existente',
      'title.required'      =>'Debe ingresar un Titulo',
      'title.min'           =>'El titulo debe tener al menos 5 caracteres',
      'description.required'=>'Debe ingresar una descripción',
      'description.min'     =>'La descripción debe tener al menos 15 caracteres'
    ];
    $this->validate($request, $rules,$messages);

      //return $request->all();
      //dd( $request->all());
      //dd ($request->input('category_id') ?: null);
      $incident= new Incident();
      $incident->category_id = $request->input('category_id') ?: null;
      $incident->severity = $request->input('severity');
      $incident->title = $request->input('title');
      $incident->description = $request->input('description');

      $user = auth()->user();

      $incident->client_id = $user->id;
      $incident->proyect_id = $user->selected_proyect_id;
      //corregir si selected_proyect_id = null
      $incident->level_id = Proyect::find($user->selected_proyect_id)->first_level_id;


      $incident->save();

      return back();
  }

  public function editar($id)
  {
     $incident = Incident::findOrFail($id);
     $categories = $incident->proyect->categories;
     //dd($categories);
     return view('incidents.edit')->with(compact('incident','categories'));
  }

  public function update(Request $request, $id)
  {
    //validaciones
    $rules = [
      'category_id' => 'sometimes|exists:categories,id', //exists:categories,id verifica si el id en el tabla categories existe
      'severity' => 'required|in:M,N,A',
      'title' => 'required|min:5',
      'description' => 'required|min:15'
    ];
    $messages =[
      'category_id.exists'  =>'Categoria no Existente',
      'title.required'      =>'Debe ingresar un Titulo',
      'title.min'           =>'El titulo debe tener al menos 5 caracteres',
      'description.required'=>'Debe ingresar una descripción',
      'description.min'     =>'La descripción debe tener al menos 15 caracteres'
    ];
    $this->validate($request, $rules,$messages);

      //return $request->all();
      //dd( $request->all());
      //dd ($request->input('category_id') ?: null);
      $incident= Incident::findOrFail($id);
      $incident->category_id = $request->input('category_id') ?: null;
      $incident->severity = $request->input('severity');
      $incident->title = $request->input('title');
      $incident->description = $request->input('description');

      $incident->save();

      return redirect("/ver/$id");
  }

public function atender($id)
{
  $user = auth()->user();
//si el usuario no es soporte, vuelve
  if (! $user->is_support) {
    return back();
  }
  $incident = Incident::findOrFail($id);
  //busca el usuario esta relacionado con el proyecto
  $proyect_user = ProyectUser::where('proyect_id', $incident->proyect_id)
                              ->where('user_id', $user->id)->first();
//si no corresponde al user ´proyecto
  if (! $proyect_user) {
    return back();
  }
  //si el usuario no tiene el mismo nivel del proyecto, retorna
  if ($proyect_user->level_id  != $incident->level_id) {
    return back();
  }
//si pasa las validaciones anteriores, se graba la atencion del soporte
  $incident->support_id = $user->id;
  $incident->save();

  return back();
}

public function resolver($id)
{
  $incident = Incident::findOrFail($id);
  //verifica que el autor de la incidencia es el mismo que lo va  a cerrar
  if ($incident->client_id != auth()->user()->id) {
    return back();
  }

  $incident->active = 0;  //false
  $incident->save();
  return back();
}
public function abrir($id)
{
  $incident = Incident::findOrFail($id);
  //verifica que el autor de la incidencia es el mismo que lo va  a cerrar
  if ($incident->client_id != auth()->user()->id) {
    return back();
  }

  $incident->active = 1;  //true
  $incident->save();
  return back();
}
//public function editar($id)
//{
  //$incident = Incident::findOrFail($id);
//}
public function derivar($id)  //deriva a un nivel superior
{
  $incident = Incident::findOrFail($id);
  $level_id = $incident->level_id;

  $proyect = $incident->proyect;
  $levels =  $proyect->levels;

  $proximo_level_id = $this->getProxLevelId($level_id, $levels);

  if ($proximo_level_id) {
    $incident->level_id = $proximo_level_id;
    $incident->support_id = null;
    $incident->save();
    return back();
  }


  return back()->with('notification', 'No es posible derivar, no hay mas niveles');
}

//funcion para encontrar el siguiente nivel disponible del proyecto
public function getProxLevelId($level_id, $levels)
{
  //si hay menor o igual que el numero de nivel
  if(sizeof($levels) <= 1){
    return null;
  }
  $posicion = -1;
  for ($i=0; $i <  sizeof($levels)-1; $i++) {
    if ($levels[$i]->id == $level_id) {
      $posicion = $i;
      break;
    }
  }

  if ($posicion == -1) {
    return null;
  }

  return $levels[$posicion+1]->id;

}

}

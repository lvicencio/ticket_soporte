<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

public function store(Request $request)
{
  //dd($request->all());
  $rules = [
        'message' => 'required|min:5|max:255'
  ];
  $messages = [
        'message.required'  => 'Debe Ingresar un mensaje',
        'mesagge.min'       => 'Minimo 5 caracteres',
        'mesagge.max'       => 'Maximo 255 caracteres'
  ];

  $this->validate($request, $rules, $messages);

  $message = new Message();
  $message->incident_id = $request->input('incident_id');
  $message->user_id     = auth()->user()->id;
  $message->message     = $request->input('message');

  $message->save();

  return back()->with('notification', 'Mensaje enviado con Exito');
}

}

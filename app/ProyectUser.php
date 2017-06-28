<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectUser extends Model
{
    protected $table = 'proyect_user';

    public function proyect()
    {
      return $this->belongsTo('App\Proyect');
    }
    public function level()
    {
      return $this->belongsTo('App\Level');

    }
}

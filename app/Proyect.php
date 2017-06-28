<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyect extends Model
{
    use SoftDeletes;

    public static $rules =[
          'name'        =>'required',
          //'description' =>'',
          'start'       =>'date'
      ];
    public static  $messages = [
          'name.required' =>'Es necesario un nombre para el Proyecto',
          'start.date'    =>'La fecha tiene formato incorrecto'
      ];

    protected $fillable = [
      'name', 'description','start',
    ];

    protected $hidden = [
        'remember_token',
    ];

    //relaciones
    public function users()
    {
      return $this->belongsToMany('App\User');
    }

    public function categories()
    {
      return $this->hasMany('App\Category');
    }
    public function levels()
    {
      return $this->hasMany('App\Level');
    }

    //accesador
    public function getFirstLevelIdAttribute()
    {
      return $this->levels->first()->id;
    }
}

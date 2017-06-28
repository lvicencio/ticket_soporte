<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    public function category()
    {
      return $this->belongsTo('App\Category');
    }
    public function proyect()
    {
      return $this->belongsTo('App\Proyect');
    }
    public function level()
    {
      return $this->belongsTo('App\Level');
    }
    public function support()
    {
      return $this->belongsTo('App\User','support_id');
    }
    public function client()
    {
      return $this->belongsTo('App\User','client_id');
    }
    public function messages()
    {
      return $this->hasMany('App\Message');
    }

    public function getSeverityFullAttribute()
    {
      switch ($this->severity) {
        case 'M':
          return 'Menor';
        case 'N':
            return 'Normal';
        case 'A':
            return 'Alta';
      }
    }

    public function getTitleResumenAttribute()
    {
      return mb_strimwidth($this->title, 0, 20, '...');
    }

    public function getCategoryNameAttribute()
    {
      if ($this->category) {
        return $this->category->name;
      }
      return 'General';
    }

    public function getSupportNameAttribute()
    {
      if ($this->support) {
        return $this->support->name;
      }
      return 'Sin Asignar';
    }

    public function getStateAttribute()
    {
      if ($this->active  == 0) {
        return 'Resuelto';
      }
      if ($this->support_id) {
        return 'Asignado';
      }
      return 'Pendiente';
    }

    public function scopebuscador($query, $name)
    {
    	return $query->where('title', 'LIKE', '%'.$name.'%')
                  ->orWhere('description', 'LIKE', '%'.$name.'%');
    }
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //relaciones con otros modelos

    public function proyects()
    {
      return $this->belongsToMany('App\Proyect');
    }

    //fin relaciones
    //Accesadores

    public function puedeTomar(Incident $incident)
    {
      return ProyectUser::where('user_id', $this->id)
                    ->where('level_id', $incident->level_id)
                    ->first();
    }

    public function getAvatarFotoAttribute()
    {
      # para asignar el vatar a client o usuario soporte
      if ($this->is_client) {
        return '/images/clientes.png';
      }
      return '/images/support.png';
    }

    public function getListOfProyectsAttribute() //se llama como list_of_proyects
    {
      if ($this->role == 1) { //soporte user
          return $this->proyects;
      }
        return Proyect::all();
    }

    public function getIsAdminAttribute()
    {
      # pregunta si es usuario administrador (role ==0 )
      return $this->role == 0;
    }

    public function getIsSupportAttribute()
    {
      # pregunta si es usuario soporte (role ==1 )
      return $this->role == 1;
    }

    public function getIsClientAttribute()
    {
        # pregunta si es usuario cliente (role ==2)
        return $this->role == 2;
    }


    public function scopebuscador($query, $name)
    {
    	return $query->where('name', 'LIKE', '%'.$name.'%');
    }

}

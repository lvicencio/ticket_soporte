<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','proyect_id'];

    public function project()
    {
      return $this->belongsTo('App\Proyect');
    }
}

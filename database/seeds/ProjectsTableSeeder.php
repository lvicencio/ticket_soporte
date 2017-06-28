<?php

use Illuminate\Database\Seeder;
use App\Proyect;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Proyect::create([
        'name'=>'Proyecto A',
        'description'=>'Proyecto A sera entorno Web Laravel'
      ]);
      Proyect::create([
        'name'=>'Proyecto B',
        'description'=>'Proyecto B sera entorno de Escritorio en C#'
      ]);
    }
}

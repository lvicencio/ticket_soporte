<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
          'name'  =>'Atención por Telefono',
          'proyect_id' => 1
        ]);
        Level::create([
          'name'  =>'Tecnico a domicilio',
          'proyect_id' => 1
        ]);
        Level::create([
          'name'  =>'Mesa de Ayuda',
          'proyect_id' => 2
        ]);
        Level::create([
          'name'  =>'Consulta Tecnica',
          'proyect_id' => 2
        ]);
    }
}

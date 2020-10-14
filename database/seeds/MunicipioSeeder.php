<?php

use App\Municipio;
use Illuminate\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \League\Csv\Exception
     */

    public function run()
    {
        //factory(Municipio::class, 150)->create();
        foreach (BoyacaHelper::getDataFileCVS('Municipios.csv',',') as $offset => $record) {
            //Municipio::create($record);
            Municipio::create([
                'id' => $record['id'],
                'nombre' => $record['nombre'],
                'departamento_id' => $record['departamento_id'],
                'estado' => $record['estado'],
            ]);
        }
    }
}

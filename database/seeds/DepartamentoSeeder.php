<?php

use App\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(Departamento::class, 50)->create();
        foreach (BoyacaHelper::getDataFileCVS('Departamentos.csv', ',') as $offset => $record) {
            //Departamento::create($record);
            Departamento::create([
                'id' => $record['id'],
                'nombre' => $record['nombre'],
                'region' => $record['region'],
                'estado' => $record['estado'],
            ]);
        }
    }
}

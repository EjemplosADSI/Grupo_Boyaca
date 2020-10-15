<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables(['departamentos','municipios','empresas','users', 'menus']);
        $this->call(DepartamentoSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(EmpresaSeeder::class);
        //$this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
    }

    public function truncateTables(array $Tables): void
    {
        Schema::disableForeignKeyConstraints();
        foreach ($Tables as $Table){
            DB::table($Table)->truncate();
        }
        Schema::enableForeignKeyConstraints();
    }
}

<?php

use App\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(Menu::class, 50)->create();
        foreach (BoyacaHelper::getDataFileCVS('Menus.csv',',') as $offset => $record) {
            //Menu::create($record);
            Menu::create([
                'id' => $record['id'],
                'parent_id' => ($record['parent_id'] == 'NULL') ? NULL : $record['parent_id'],
                'title' => $record['title'],
                'description' => $record['description'],
                'model' => $record['model'],
                'route' => $record['route'],
                'order' => $record['order'],
                'icon' => $record['icon'],
                'enabled' => $record['enabled'],
            ]);
        }
    }
}

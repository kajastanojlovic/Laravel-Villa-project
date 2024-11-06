<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $menu =['Home', 'Properties', 'Contact Us'];
    private $route=['home', 'properties', 'contact'];
    public function run(): void
    {
        for($i = 0; $i < count($this->menu); $i++)
        {
            DB::table('menus')->insert(
                [
                    'name'=>$this->menu[$i],
                    'route'=>$this->route[$i]
                ]
            );
        }
    }
}

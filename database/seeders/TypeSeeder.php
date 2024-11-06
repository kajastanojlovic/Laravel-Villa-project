<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private  $type = ['House', 'Villa', 'Condo'];
    public function run(): void
    {
        foreach ($this->type as $t)
        {
            DB::table('real_estate_types')->insert([
                    'type' => $t
                ]);
        }
    }
}

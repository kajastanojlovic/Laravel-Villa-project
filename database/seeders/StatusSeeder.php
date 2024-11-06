<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $status = ['Active', 'Coming soon', 'Sold'];
    public function run(): void
    {
        foreach ($this->status as $s){
            DB::table('status')->insert([
                'status'=>$s
            ]);
        }
    }
}

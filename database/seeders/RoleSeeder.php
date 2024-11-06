<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $roles=['superadmin','admin', 'user'];
    public function run(): void
    {
        foreach($this->roles as $r)
        {
            DB::table('roles')->insert(
                [
                    'role'=>$r
            ]);
        }
    }
}

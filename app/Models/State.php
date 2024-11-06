<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class State extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->hasOne(City::class);
    }
    public function getState()
    {
        return DB::table('states')->get();

    }
}

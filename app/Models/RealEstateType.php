<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealEstateType extends Model
{
    use HasFactory;

    public function realEstate()
    {
        return $this->hasMany(RealEstate::class);
    }

    public function getType()
    {
        $data = DB::table('real_estate_types')->get();
        return $data;
    }

    public function getOneType($data, $t)
    {
        return  DB::table('real_estate')
            ->where('id', $data)
            ->where('type_id', $t)
            ->get();

    }
}

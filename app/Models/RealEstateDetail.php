<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstateDetail extends Model
{
    use HasFactory;

    public function real_estate()
    {
        return $this->hasOne(RealEstate::class, 'details_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Type;

class RealEstate extends Model
{
    use HasFactory;
    protected $table = 'real_estate';
    protected $table1 = 'real_estate_types';

    public function type()
    {
        return $this->belongsTo(RealEstateType::class);
    }

    public  function details()
    {
        return $this->belongsTo(RealEstateDetail::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getProperty()
    {
        return DB::table('real_estate')
            ->get();

//        ->join('real_estate_details', 'details_id','=',
//        'real_estate_details.id')
//        ->select('real_estate.*','real_estate_details.*')
    }
    public function getHomePageProps()
    {
        return DB::table('real_estate')
            ->limit(3)
            ->get();
    }

    public function getOneProp($id)
    {
        return DB::table('real_estate')
            ->join('real_estate_details', 'details_id','=', 'real_estate_details.id')
            ->join('real_estate_types', 'type_id', '=', 'real_estate_types.id')
            ->select('real_estate.id as idRealEstate', 'real_estate.*','real_estate_details.*', 'real_estate_types.*', 'real_estate_types.id')
            ->where('real_estate.id',$id)
            ->get();
    }

//    public function getType($tID)
//    {
//        $getPropID = RealEstate::select('id')
//            ->where('type_id',$tID)
//            ->pluck('id');
//        $getTypeId = RealEstate::select('type_id')
//            ->where('id', $getPropID)
//            ->groupBy('type_id')->pluck('type_id');
//
//        $getType=Type::select('id','type')
//
////        dd($getTypeId);
//
//    }

}

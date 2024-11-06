<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use App\Models\RealEstateType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $post = RealEstate::with('type')
            ->with('city')
            ->paginate(3);

        $modelType = new RealEstateType();
        $t = $modelType->getType();

        return view('pages.main.home',['prop'=>$post, 'type'=>$t]);
    }


}

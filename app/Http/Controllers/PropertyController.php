<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use App\Models\PropertyModel;
use App\Models\RealEstate;
use App\Models\State;
use App\Models\RealEstateType;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;
use Psy\Util\Json;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = RealEstate::with('type')
            ->with('city')
            ->paginate(6);
//        dd($post);
        $modelType = new RealEstateType();
        $t = $modelType->getType();

        return view('pages.properties.properties', ['prop'=>$post, 'type'=>$t]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stateModel = new State();
        $state = $stateModel->getState();

        $ddlType = new RealEstateType();
        $ddl = $ddlType->getType();
        return view('admin.propertyCreate',['ddl'=>$ddl, 'state'=>$state]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $request->validate([
                'total_space'=>'required|integer|min:1',
                'number_of_bathrooms'=>'required|integer|min:1',
                'number_of_bedrooms'=>'required|integer|min:1',
                'number_of_floors'=>'required|integer|min:1',
                'type_id'=>'required|exists:real_estate_types,id',
                'garage_spaces'=>'required|integer|min:0',
                'has_a_pool'=>'required',
                'numbers_of_balcony'=>'required|integer|min:0',
                'year_built'=>'required|integer|min_digits:4|max_digits:4',
                'agreement_type'=>'required|in:cnd,sfr,asd',
                'price'=>'required|max_digits:10|numeric|min:1',
                'image'=>'required|mimes:jpg,png|max:2048',
                'address'=>'required|string|regex:/^[A-Za-z0-9\.\-\s\,]*$/',
                'address_number'=>'required|integer|min:1',
                'state_id'=>'required|exists:states,id'
            ]);

        try {
            $img = $request->image;
            $imageName = time() . '.' . $img->extension();
            $img->move(public_path('assets/images'),$imageName);

            $id_city = DB::table('cities')->insertGetId(
                [
                    'address'=>$request->address,
                    'address_number'=>$request->address_number,
                    'state_id'=>$request->state_id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]
            );

            $id_details = DB::table('real_estate_details')->insertGetId(
                [
                    'garage_spaces'=>$request->garage_spaces,
                    'has_a_pool'=>$request->has_a_pool,
                    'numbers_of_balcony'=>$request->numbers_of_balcony,
                    'year_built'=>$request->year_built,
                    'agreement_type'=>$request->agreement_type,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]
            );

            DB::table('real_estate')->insert(
                [
                'total_space'=>$request->total_space,
                'number_of_bathrooms'=>$request->number_of_bathrooms,
                'number_of_bedrooms'=>$request->number_of_bedrooms,
                'number_of_floors'=>$request->number_of_floors,
                'type_id'=>$request->type_id,
                'details_id'=>$id_details,
                 'city_id'=>$id_city ,
                 'price'=>$request->price,
                 'image'=>$imageName
                ]
            );


            return redirect()->back()
                ->with('success', 'Property successfully added. ');
        }catch (\Exception $e)
        {
            dd($e->getMessage());
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error','Property failed to add.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = RealEstate::with('type')
            ->with('details')
            ->find($id);
//        $model = new RealEstate();
//        $prop = $model->getOneProp($id);
//        dd($model);

        return view('pages.properties.property-details', ['prop'=>$model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ddlType = new RealEstateType();
        $ddl = $ddlType->getType();

        $model = new RealEstate();
        $prop = $model->getOneProp($id);
        //dd($prop->first()->idRealEstate);
        return view('admin.propertyEdit', ['prop'=>$prop, 'ddl'=>$ddl]);
        //logika za resize slike
        //php prezentacija
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //logika za resize slike
        $request->validate([
            'total_space'=>'required|integer|min:1',
            'number_of_bathrooms'=>'required|integer|min:1',
            'number_of_bedrooms'=>'required|integer|min:1',
            'number_of_floors'=>'required|integer|min:1',
            'type_id'=>'required|exists:real_estate_types,id',
            'garage_spaces'=>'required|integer|min:0',
            'has_a_pool'=>'required',
            'numbers_of_balcony'=>'required|integer|min:0',
            'year_built'=>'required|integer|min_digits:4|max_digits:4',
            'agreement_type'=>'required|in:cnd,sfr,asd',
            'price'=>'required|max_digits:12|numeric|min:1',
            'image'=>'required|extensions:jpg,png|max:2048'
        ]);
        //dd($request);
        $idDetails = DB::table('real_estate')->find($id)->details_id;
           //dd($idDetails);

        try {
            $image = $request->image;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('assets/images'), $imageName);


            DB::beginTransaction();

            DB::table('real_estate_details')->where('id', $idDetails)
                ->update(
                [
                    'garage_spaces'=>$request->garage_spaces,
                    'has_a_pool'=>$request->has_a_pool,
                    'numbers_of_balcony'=>$request->numbers_of_balcony,
                    'year_built'=>$request->year_built,
                    'agreement_type'=>$request->agreement_type,
                    'updated_at'=>date('Y-m-d H:i:s')
                ]
            );
            DB::table('real_estate')->where('id', $id)
                ->update([
                    'total_space'=>$request->total_space,
                    'number_of_bathrooms'=>$request->number_of_bathrooms,
                    'number_of_bedrooms'=>$request->number_of_bedrooms,
                    'number_of_floors'=>$request->number_of_floors,
                    'type_id'=>$request->type_id,
                    'price'=>$request->price,
                    'image'=>$imageName,
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);


            DB::commit();
            return redirect()->back()->with('success', 'Property successfully edited.');

        }catch (\Exception $e)
        {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //brisanje property klikom na dugme
        try{
            DB::beginTransaction();
            $data = DB::table('real_estate')->find($id);
            $idDetails = $data->details_id;
            DB::table('real_estate')
                ->where('id','=',$id)
                ->delete();
            DB::table('real_estate_details')
                ->where('id', $idDetails)
                ->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Product deleted successfully.');
        }catch (\Exception $e)
        {
            DB::rollBack();
//            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function filter(Request $request)
    {
        $id = $request->ajax();
        $data = DB::table('real_estate')
            ->where('type_id', $id)
            ->get();
        //dd($data);

        return Json::encode($data);

    }
}

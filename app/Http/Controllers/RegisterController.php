<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PharIo\Version\Exception;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.login.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterUserRequest $request)
    {
        $pass = $request->password;
        $kaja = Hash::make($pass);

        $data = $request->only('first_name','last_name','number','address',
            'email');
        $role_id = 3;
        //dd($data);
        try {
            $user = DB::table('users')->insert(
                [
                    'first_name'=>$data['first_name'],
                    'last_name'=>$data['last_name'],
                    'number'=>$data['number'],
                    'address'=>$data['address'],
                    'email'=>$data['email'],
                    'password'=>$kaja,
                    'role_id'=>$role_id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')

                ]
            );

            $request->session()->put('user', $user);
            return redirect()->back()
                ->with('success', "Registration success.");
        }
        catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', "Please try again.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

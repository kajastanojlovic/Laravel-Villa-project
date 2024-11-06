<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function create()
    {
        return view('pages.main.contact');
    }
    public function scheduleCreate()
    {
        return view('pages.main.schedule-visit');
    }

    public function scheduleVisit(Request $request, $id)
    {
        $request->validate([
           'visit->date'=>'required|date|after:tomorrow',
           'visit_time'=>'required'
        ]);
//        dd($id);
        try {
            $data = DB::table('schedule_visit')->insert(
                [
                    'visit_date'=>$request->visit_date,
                    'visit_time'=>$request->visit_time,
                    'user_id'=>$id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]
            );
            return redirect()->back()
                ->with('success', 'We appreciate you contact Villa.
                One of our colleagues will get back in touch with you soon.');
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Please try again.');
        }

    }
}

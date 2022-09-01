<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Appointment;
use App\Models\Event;
use App\Models\User;
use Session;
use Auth;
use DB;

class AppointmentController extends Controller
{
    function viewAddPage($id)
    {
        $events= DB::table('events')
        ->join('schedules', 'events.id', '=' ,'schedules.event_id')
        ->select('events.*', 'schedules.start_datetime', 'schedules.end_datetime')
        ->where('events.id',$id)
        ->get();

        return view('appointment_add_view')->with('events', $events);
    }

    function add()
    {
        $r = request();
        
        $status = ($r->amount == "Free")? "confirm" : "unpaid";

        $appointments = Appointment::create([
            'event_id'=>$r->event_id,
            'user_id'=>$r->user_id,
            'reason'=>$r->reason,
            'status'=>$status,
            'start_datetime'=>$r->start_datetime,
            'end_datetime'=>$r->end_datetime,
        ]);

        /*
         * minus one for attendance quantity
         */
        
        if($r->amount == "Free"){
        
            return redirect()->route('appointment.view');
            
        }else{
            // redirect to payment page
            return redirect()->route('payment.view',['id'=>$appointments->id]);

        }

    }

    function view()
    {
        $appointments= DB::table('appointments')
        ->join('schedules', 'events.id', '=' ,'schedules.event_id')
        ->select('events.*', 'schedules.start_datetime', 'schedules.end_datetime')
        ->where('events.id',$id)
        ->get();

        return view('appointment_view')->with('appointments', $appointments);
    }
}

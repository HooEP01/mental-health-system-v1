<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Appointment;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Auth;
use DB;

class AppointmentController extends Controller
{
    /*
    | Professional
    */
    public function view()
    {
        /*
        | Appointment page
        | - event's professional id 
        | - start date time >= today
        | - appointment status != unpaid
        | - start date time in ascending order
        */
        $appointments = DB::table('appointments')
        ->leftjoin('users', 'users.id', '=', 'appointments.user_id')
        ->leftjoin('events', 'events.id', '=', 'appointments.event_id')
        ->select('appointments.*', 'events.professional_id', 'users.name as user_id', 'events.title as event_id')
        ->where('events.professional_id', '=', Auth::id())
        ->where('appointments.start_datetime', '>=', Carbon::today())
        ->where('appointments.status', '!=', 'Unpaid')
        ->orderBy('appointments.start_datetime','asc')
        ->paginate(10);

        return view('professional.appointment')->with('appointments', $appointments);
    }

    public function filterStatus($status)
    {
        $appointments = DB::table('appointments')
        ->leftjoin('users', 'users.id', '=', 'appointments.user_id')
        ->leftjoin('events', 'events.id', '=', 'appointments.event_id')
        ->select('appointments.*', 'events.professional_id', 'users.name as user_id', 'events.title as event_id')
        ->where('events.professional_id', '=', Auth::id())
        ->where('appointments.start_datetime', '>=', Carbon::today())
        ->where('appointments.status', '=', $status)
        ->orderBy('updated_at','desc')
        ->paginate(10);

        return view('professional.appointment')->with('appointments', $appointments);
    }

    public function complete($id)
    {
        $appointment = Appointment::find($id);
        $appointment->status = "Complete";
        $appointment->save();
        return redirect()->route('professional.appointment.view');
    }

    public function approve($id)
    {
        $appointment = Appointment::find($id);
        $appointment->status = "Approve";
        $appointment->save();
        return redirect()->route('professional.appointment.view');
    }

    public function cancel($id)
    {
        $appointment = Appointment::find($id);
        $appointment->status = "Cancel";
        $appointment->save();
        return redirect()->route('professional.appointment.view');
    }

    /*
    | User
    */
    function userAdd($id)
    {
        $events= DB::table('events')
        ->join('schedules', 'events.id', '=' ,'schedules.event_id')
        ->select('events.*', 'schedules.start_datetime', 'schedules.end_datetime', 'schedules.periodical')
        ->where('events.id', '=', $id)
        ->get();
        return view('appointment_add')->with('events', $events);
    }

    function userCreate()
    {
        $r = request();
        $status = ($r->amount == "0.00")? "Join" : "Unpaid";
        $appointments = Appointment::create([
            'event_id'=>$r->event_id,
            'user_id'=>$r->user_id,
            'reason'=>$r->reason,
            'status'=>$status,
            'start_datetime'=>$r->start_datetime,
            'end_datetime'=>$r->end_datetime,
        ]);
        
        if($r->amount == "0.00"){
            return redirect()->route('appointment.view');  
        }else{
            // redirect to payment page
            return redirect()->route('user.payment.view',['id'=>$appointments->id]);
        }
    }

    function userView()
    {
        $appointments= DB::table('appointments')
        ->join('events', 'events.id', '=', 'appointments.event_id')
        ->select('appointments.*', 'events.*')
        ->get();
        
        return view('appointment')->with('appointments', $appointments);
    }
}

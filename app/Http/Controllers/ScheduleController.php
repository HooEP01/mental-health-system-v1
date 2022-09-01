<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Event;
use Carbon\Carbon;
use Session;
use Auth;
use DB;

class ScheduleController extends Controller
{


    /*
    | Event's schedule(s) for Group & Individual Event
    */

    /*
    | Professional
    */

    public function view($event_id)
    {
        $schedules = DB::table('schedules')
        -> select('schedules.*')
        -> where('schedules.event_id','=', $event_id)
        -> orderBy('created_at','desc')
        -> get();
        return view('professional.event_schedule')->with('schedules', $schedules);
    }

    public function create() 
    {
        $r=request();
        $start_datetime = date('Y-m-d H:i:s', strtotime("$r->startAt $r->startTime"));
        $end_datetime = date('Y-m-d H:i:s', strtotime("$r->endAt $r->endTime"));
        $schedules=Schedule::create([
            'event_id'=>$r->event_id,
            'periodical'=>$r->periodical,
            'day'=>$r->day,
            'start_datetime'=>$start_datetime,
            'end_datetime'=>$end_datetime,
        ]);
        $event_id = $r->event_id;
        return redirect()->route('professional.event.schedule.view',['id'=>$event_id]);
    }

    public function edit($id)
    {
        $schedule = Schedule::all->where('id',$id);
        return view('professional.event.schedule.edit')->with('schedule', $schedule);
    }

    public function update()
    {
        $r = request();
        $start_datetime = date('Y-m-d H:i:s', strtotime("$r->startAt $r->startTime"));
        $end_datetime = date('Y-m-d H:i:s', strtotime("$r->endAt $r->endTime"));
        $schedule=Schedule::find($r->id);
        $schedule->periodical=$r->periodical;
        $schedule->day=$r->day;
        $schedule->start_datetime=$start_datetime;
        $schedule->end_datetime=$end_datetime;
        $schedule->save();
        $event_id = $r->event_id;
        return redirect()->route('professional.event.schedule.view',['id'=>$event_id]);
    }

    public function delete($id)
    {
        $schedule=Schedule::find($id);
        $event_id = $schedule->event_id;
        $schedule->delete();
        return redirect()->route('professional.event.schedule.view',['id'=>$event_id]);
    }
}

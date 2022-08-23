<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Schedule;
use Session;
use Auth;
use DB;

class ScheduleController extends Controller
{
    public function view()
    {

        $schedules = DB::table('schedules')
        -> select('schedules.*')
        -> where('schedules.professional_id','=',Auth::id())
        -> orderBy('created_at','desc')
        -> paginate(5);

        foreach($schedules as $schedule){
            $today = $schedule->day;
            $strToday = "";
            switch($today){
                case "0": $strToday = "Monday"; break;
                case "1": $strToday = "Tuesday"; break;
                case "2": $strToday = "Wednesday"; break;
                case "3": $strToday = "Thursday"; break;
                case "4": $strToday = "Friday"; break;
                case "5": $strToday = "Saturday"; break;
                case "6": $strToday = "Sunday"; break;
            }
            $schedule->day = $strToday;

            // turn hours to end_time
            $start_time = $schedule->start_time;
            $hour = $schedule->hour;
            $end_time = (int)$start_time + $hour;
            if($end_time < 10){
                $schedule->hour = "0" . strval($end_time) . ":00";
            }
            $schedule->hour = strval($end_time) . ":00";

        }


        // locate at views/professional/schedule.blade.php
        return view('professional.schedule')->with('schedules', $schedules);
    }

    public function add()
    {
        $r=request();

        $schedules=Schedule::create([
            'professional_id'=>$r->professional_id,
            'day'=>$r->day,
            'start_date'=>$r->startAt,
            'end_date'=>$r->endAt,
            'start_time'=>$r->startTime,
            'hour'=>$r->hour,
        ]);

        return redirect()->route('schedule.view');
    }

    public function delete($id){
        $schedules=Schedule::find($id);
        $schedules->delete();
        
        return redirect()->route('schedule.view');
    }
}

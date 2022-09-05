<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Event;
use Session;
use Auth;
use DB;

class EventController extends Controller
{
 
    /* 
    | professional 
    */

    /*
    | Own event
    */

    public function view()
    {
        $individuals = DB::table('events')
        -> select('events.*')
        -> where('events.professional_id','=',Auth::id())
        -> where('events.type','=','Individual Counselling')
        -> orderBy('created_at','desc')
        -> get();
        $groups = DB::table('events')
        -> select('events.*')
        -> where('events.professional_id','=',Auth::id())
        -> where('events.type','!=','Individual Counselling')
        -> orderBy('created_at','desc')
        -> get();
        $schedules = DB::table('schedules')
        -> join('events','events.id','=','schedules.event_id')
        -> select('schedules.*', 'events.id', 'events.professional_id')
        -> where('events.professional_id','=',Auth::id())
        -> orderBy('day','desc')
        -> get();
        return view('professional.event')->with('individuals',$individuals)->with('groups', $groups)->with('schedules', $schedules);
    }
    
    public function add($type)
    {
        return view('professional.event_add')->with('type', $type);
    }

    public function create()
    {
        $r = request();
        $imageName='';
        if($r->file('image')!= ''){
            $image=$r->file('image');
            $image->move('event',$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();
        }
        $event = Event::create([
            'professional_id'=>$r->professional_id,
            'type'=>$r->type,
            'attendance_quantity'=>$r->attendance_quantity,
            'amount'=>$r->amount,
            'image'=>$imageName,
            'title'=>$r->title,
            'description'=>$r->description,
        ]);
        $event_id = $event->id;
        return redirect()->route('professional.event.schedule.view',['id'=>$event_id]); // return to schedule page
    }

    public function edit($id){
        $events=Event::all()->where('id',$id);
        $schedules = DB::table('schedules')
        -> select('schedules.*')
        -> where('schedules.event_id','=', $id)
        -> orderBy('created_at','desc')
        -> paginate(6);

        return view('professional.event_detail')->with('events',$events)->with('schedules',$schedules);
    }

    public function update()
    {
        $r=request();
        // image
        $imageName='';
        if($r->file('image')!= ''){
            $image=$r->file('image');
            $image->move('event',$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();
        }
        $events=Event::find($r->id);
        $events->type=$r->type;
        $events->attendance_quantity=$r->attendance_quantity;
        $events->amount=$r->amount;
        $events->image=$r->imageName;
        $events->title=$r->title;
        $events->description=$r->description;
        $events->save();
        return redirect()->route('professional.event.view');
    }

    public function delete($id)
    {
        $r = request();
        $events=Event::find($id);
        $events->delete();
        return redirect()->route('professional.event.view');
    }


    /*
    | All event
    */
    public function viewAll()
    {
        $individuals = DB::table('events')
        -> select('events.*')
        -> where('events.type','=','Individual Counselling')
        -> orderBy('created_at','desc')
        -> paginate(6);
        $groups = DB::table('events')
        -> select('events.*')
        -> where('events.type','!=','Individual Counselling')
        -> orderBy('created_at','desc')
        -> paginate(6);
        return view('professional.event')->with('individuals',$individuals)->with('groups', $groups);
    }

    /*
    | User
    */

       public function userView()
       {
           $events = DB::table('events')
           -> select('events.*')
           -> orderBy('created_at','desc')
           -> paginate(6);
           return view('event')->with('events',$events);
       }
   
}

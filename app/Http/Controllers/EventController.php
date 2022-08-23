<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Event;
use Session;
use Auth;
use DB;

class EventController extends Controller
{
    // professional 
    public function view()
    {
        $events = DB::table('events')
        -> select('events.*')
        -> where('events.professional_id','=',Auth::id())
        -> orderBy('created_at','desc')
        -> paginate(6);

        return view('professional.event')->with('events',$events);
    }

    public function add()
    {
        $r = request();

        // image
        $imageName='';
        if($r->file('image')!= ''){
            $image=$r->file('image');
            $image->move('event',$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();
        }

        $events = Event::create([
            'professional_id'=>$r->professional_id,
            'type'=>$r->type,
            'attendance_quantity'=>$r->attendance_quantity,
            'amount'=>$r->amount,
            'image'=>$imageName,
            'title'=>$r->title,
            'description'=>$r->description,
        ]);

        return redirect()->route('professional.event.view');
    }

    public function edit($id){
        $events=Event::all()->where('id',$id);
        return view('professional.event_detail')->with('events',$events);
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
}

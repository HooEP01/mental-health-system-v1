<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use Session;
use Auth;
use DB;

class ProfessionalController extends Controller
{
    
    public function view(){
        $users = DB::table('professionals')
        ->where('professionals.id','=',Auth::id())
        ->get();
        
        return view('professional.profile')->with('users',$users);
    }

    public function update(){
        $r=request();

        // image
        $imageName='';
        if($r->file('image')!= ''){
            $image=$r->file('image');
            $image->move('profile',$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();
        }

        $professionals=Professional::find($r->id);
        $professionals->title=$r->title;
        $professionals->bio=$r->bio;
        $professionals->linkedln=$r->linkedln;
        $professionals->image=$imageName;
        $professionals->save();
        
        return redirect()->route('professional.profile.view');
    }
}

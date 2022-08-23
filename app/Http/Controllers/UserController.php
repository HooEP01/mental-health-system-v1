<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class UserController extends Controller
{
    /**
     * User's Profile
     */

    public function view(){
        $users = DB::table('users')
        ->where('users.id','=',Auth::id())
        ->get();
        
        return view('profile')->with('users',$users);
    }

    public function update(){
        $r=request();
        $users=User::find($r->id);

        $users->fullname=$r->fullname;
        $users->year_of_birth=$r->year_of_birth;
        $users->gender=$r->gender;
        $users->first_language=$r->first_language;
        $users->second_language=$r->second_language;
        $users->relationship_status=$r->relationship_status;
        $users->save();
        
        Session::flash('success',"Product update successfully!");
        return redirect()->route('profile.view');
    }
}

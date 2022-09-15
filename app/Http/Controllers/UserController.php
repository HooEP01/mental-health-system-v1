<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

        $users->birthday=$r->birthday;
        $users->gender=$r->gender;
        $users->language=$r->language;
        $users->relationship_status=$r->relationship_status;
        $users->contact_number=$r->contact_number;
        $users->save();
        
        return redirect()->route('user.profile.view');
    }
}

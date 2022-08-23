<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Content;
use App\Models\ContentDetail;
use Session;
use Auth;
use DB;

class ContentController extends Controller
{
    // professional 
    public function view()
    {
        $contents = DB::table('contents')
        -> select('contents.*')
        -> where('contents.professional_id','=',Auth::id())
        -> orderBy('created_at','desc')
        -> paginate(6);

        return view('professional.content')->with('contents',$contents);
    }

    public function add()
    {
        $r = request();

        $imageName='';
        if($r->file('image')!= ''){
            $image=$r->file('image');
            $image->move('content',$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();
        }
        $contents = Content::create([
            'professional_id'=>$r->professional_id,
            'type'=>$r->type,
            'category'=>$r->category,
            'image'=>$imageName,
            'title'=>$r->title,
            'summary'=>$r->summary,
        ]);

        return redirect()->route('professional.content.view');
    }

    // professional detail
    public function viewDetail($id){

        $contents=Content::find($id);

        $content_details = DB::table('content_details')
        -> select('content_details.*')
        -> where('content_details.content_id','=',$id)
        -> orderBy('created_at','asc')
        -> paginate(10);

        return view('professional.content_detail')->with('contents', compact('contents'))->with('content_details', $content_details);
    }

    public function addDetail(){
        $r = request();

        $imageName='';
        if($r->file('image')!= ''){
            $image=$r->file('image');
            $image->move('content_detail',$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();

        }

        $audioName='';
        if($r->file('audio')!= ''){
            $audio=$r->file('audio');
            $audio->move('content_detail_audio',$audio->getClientOriginalName());
            $audioName=$audio->getClientOriginalName();
        }

        $content_details = ContentDetail::create([
            'content_id'=>$r->content_id,
            'type'=>$r->type,
            'image'=>$imageName,
            'audio'=>$audioName,
            'subtitle'=>$r->subtitle,
            'description'=>$r->description,
        ]);

        return redirect()->route('professional.content_detail.view',['id'=>$r->content_id]);
    }

    public function deleteDetail($id)
    {
        $r = request();

        $content_details=ContentDetail::find($id);
        $content_details->delete();
        
        return redirect()->route('professional.content_detail.view',['id'=>$r->content_id]);
    }

}

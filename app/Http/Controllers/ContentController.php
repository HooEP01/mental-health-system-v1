<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Content;
use App\Models\ContentDetail;
use App\Models\Option;
use Session;
use Auth;
use DB;

class ContentController extends Controller
{
    /* 
    | professional 
    */

    /*
    | Own event
    */
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
        return view('professional.content_add');
    }

    public function create()
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

    public function delete($id)
    {
        $r = request();
        $contents=Content::find($id);
        $contents->delete();
        return redirect()->route('professional.content.view');
    }

    public function search()
    {
        $r=request();
        $keyword=$r->name;
        $contents=DB::table('contents')
        ->where('contents.title','like','%'.$keyword.'%')
        ->where('contents.professional_id','=',Auth::id())
        ->select('contents.*')
        ->orderBy('created_at','desc')
        ->paginate(6);
        return view('professional.content')->with('contents',$contents);
    }

    public function filter()
    {
        $r=request();
        $keyword=$r->filter;
        $contents = DB::table('contents')
        ->where('contents.professional_id','=',Auth::id())
        ->where('contents.type', $keyword)
        ->orWhere('contents.category', $keyword)
        ->orderBy('updated_at','desc')
        ->paginate(6);
        return view('professional.content')->with('contents',$contents);
    }

    public function edit($id){
        $contents=Content::all()->where('id',$id);
        return view('professional.content_edit')->with('contents',$contents);
    }

    public function update(){
        $r=request();
        $contents=Content::find($r->id);
        if($r->file('image')!= ''){
            $image=$r->file('image');
            $image->move('content',$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();
            $contents->image=$imageName;
        }
        $contents->professional_id=$r->professional_id;
        $contents->type=$r->type;
        $contents->category=$r->category;
        $contents->title=$r->title;
        $contents->summary=$r->summary;
        $contents->save();
        return redirect()->route('professional.content_detail.view',['id'=>$r->id]);
    }

    /*
    | Detail view for ( professional and user )
    */ 
    public function viewDetail($id)
    {
        // improvable 
        $contents = DB::table('contents')
        -> leftjoin('professionals','professionals.id','=','contents.professional_id')
        -> select('contents.*','professionals.name as professional_id')
        -> where('contents.id', $id)
        -> get();
        $content_details = DB::table('content_details')
        -> select('content_details.*')
        -> where('content_details.content_id','=',$id)
        -> orderBy('created_at','asc')
        -> get();
        $options = DB::table('options')
        -> join('content_details','options.content_detail_id','=','content_details.id')
        -> select('options.*', 'content_details.content_id')
        -> where('content_details.content_id','=',$id)
        -> get();
        return view('professional.content_detail')->with('contents', $contents)->with('content_details', $content_details)->with('options',$options);
    }

    /*
    | Detail for Professional
    */ 
    public function addDetail()
    {
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
        if($r->type == "Checkbox" || $r->type == "Multiple Choice"){
            $items=$r->input('opt');
            foreach($items as $item=>$value){
                $options = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$value,
                ]);
            }
        }
        return redirect()->route('professional.content_detail.view',['id'=>$r->content_id]);
    }

    public function deleteDetail($id)
    {
        $r = request();
        $content_details=ContentDetail::find($id);
        $id = $content_details->content_id;
        $content_details->delete();        
        return redirect()->route('professional.content_detail.view',['id'=>$id]);
    }

    public function editDetail($id)
    {
        $content_details = DB::table('content_details')
        -> select('content_details.*')
        -> where('content_details.id',$id)
        -> orderBy('created_at','desc')
        -> get();
        $options = DB::table('options')
        -> join('content_details','options.content_detail_id','=','content_details.id')
        -> select('options.*', 'content_details.content_id')
        -> where('content_details.id','=',$id)
        -> get();
        return view('professional.content_detail_edit')->with('content_details',$content_details)->with('options', $options);
    }

    public function updateDetail()
    {
        $r=request();
        $content_details=ContentDetail::find($r->id);
        $content_id = $content_details->content_id;
        $optionType = $content_details->type;
        $content_detail_id = $r->id;
        if($r->file('image')!= ''){
            $image=$r->file('image');
            $image->move('content_detail',$image->getClientOriginalName());
            $imageName=$image->getClientOriginalName();
            $content_details->image=$imageName;
        }
        if($r->file('audio')!= ''){
            $audio=$r->file('audio');
            $audio->move('content_detail_audio',$image->getClientOriginalName());
            $audioName=$image->getClientOriginalName();
            $contents->audio=$audioName;
        }
        $content_details->type=$r->type;
        $content_details->subtitle=$r->subtitle;
        $content_details->description=$r->description;
        $content_details->save();

        if($optionType == "Checkbox" || $optionType == "Multiple Choice"){
            $options = DB::table('options')
            -> select('options.*')
            -> where('options.content_detail_id', '=', $content_detail_id)
            -> delete();
        }
        if($r->type == "Checkbox" || $r->type == "Multiple Choice"){
            $items=$r->input('opt');
            foreach($items as $item=>$value){
                $options = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$value,
                ]);
            }
        }
        return redirect()->route('professional.content_detail.view',['id'=>$content_id]);
    }

    /*
    | Community content (view by user and professional)
    */

    public function viewAll()
    {
        $contents = DB::table('contents')
        -> select('contents.*')
        -> where('contents.is_approve','=', 1)
        -> orderBy('created_at','desc')
        -> paginate(6);
        return view('professional.content_community')->with('contents',$contents);
    }

    public function searchAll()
    {
        $r=request();
        $keyword=$r->name;
        $contents=DB::table('contents')
        ->select('contents.*')
        ->where('contents.is_approve','=', 1)
        ->where('contents.title','like','%'.$keyword.'%')
        ->orderBy('created_at','desc')
        ->paginate(6);
        return view('professional.content_community')->with('contents',$contents);
    }

    public function filterAll()
    {
        $r=request();
        $keyword=$r->filter;
        $contents = DB::table('contents')
        ->where('contents.type', $keyword)
        ->where('contents.is_approve','=', 1)
        ->orWhere('contents.category', $keyword)
        ->orderBy('updated_at','desc')
        ->paginate(6);
        return view('professional.content_community')->with('contents',$contents);
    }

    /*
    | Detail view for ( professional and user )
    */ 
    public function viewDetailAll($id)
    {
        // improvable 
        $contents = DB::table('contents')
        -> leftjoin('professionals','professionals.id','=','contents.professional_id')
        -> select('contents.*','professionals.name as professional_id')
        -> where('contents.id', $id)
        -> get();
        $content_details = DB::table('content_details')
        -> select('content_details.*')
        -> where('content_details.content_id','=',$id)
        -> orderBy('created_at','asc')
        -> get();
        $options = DB::table('options')
        -> join('content_details','options.content_detail_id','=','content_details.id')
        -> select('options.*', 'content_details.content_id')
        -> where('content_details.content_id','=',$id)
        -> get();
        return view('professional.content_community_detail')->with('contents', $contents)->with('content_details', $content_details)->with('options',$options);
    }

    /*
    | Administrator
    | Approve
    */
    public function adminView()
    {
        $contents = DB::table('contents')
        -> leftjoin('professionals','professionals.id','=','contents.professional_id')
        -> select('contents.*','professionals.name as professional_id')
        -> orderBy('updated_at','desc')
        -> paginate(10);
        return view('administrator.content')->with('contents',$contents);
    }

    public function adminApprove($id)
    {
        $contents = Appointment::find($id);
        $contents->is_approve = 1;
        $contents->save();
        return redirect()->route('administrator.content.view');
    }

}

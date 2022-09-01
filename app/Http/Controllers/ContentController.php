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

    public function delete($id)
    {
        $r = request();

        $contents=Content::find($id);
        $contents->delete();
        
        return redirect()->route('professional.content.view');
    }

    public function search(){
        $r=request();
        $keyword=$r->name;
        $contents=DB::table('contents')
        ->where('contents.title','like','%'.$keyword.'%')
        ->select('contents.*')
        ->orderBy('created_at','desc')
        ->paginate(6);

        return view('professional.content')->with('contents',$contents);
    }

    public function filter(){
        $r=request();
        $keyword=$r->filter;

        $contents = DB::table('contents')
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

    // professional detail
    public function viewDetail($id){

        $contents = DB::table('contents')
        -> leftjoin('professionals','professionals.id','=','contents.professional_id')
        -> select('contents.*','professionals.name as professional_id')
        -> where('contents.id', $id)
        -> paginate(6);

        $content_details = DB::table('content_details')
        -> select('content_details.*')
        -> where('content_details.content_id','=',$id)
        -> orderBy('created_at','asc')
        -> paginate(10);

        $options = DB::table('options')
        -> join('content_details','options.content_detail_id','=','content_details.id')
        -> select('options.*', 'content_details.content_id')
        -> where('content_details.content_id','=',$id)
        -> get();


        return view('professional.content_detail')->with('contents', $contents)->with('content_details', $content_details)->with('options',$options);
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

        if($r->type == "Checkbox" || $r->type == "Multiple Choice"){
            if($r->option1 != ""){
                $option1 = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$r->option1,
                ]);
            }
            if($r->option2 != ""){
                $option2 = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$r->option2,
                ]);
            }
            if($r->option3 != ""){
                $option3 = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$r->option3,
                ]);
            }
            if($r->option4 != ""){
                $option4 = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$r->option4,
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

    public function editDetail($id){

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

    public function updateDetail(){
        $r=request();
        $content_details=ContentDetail::find($r->id);
        $content_id = $content_details->content_id;
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

        if($r->type == "Checkbox" || $r->type == "Multiple Choice"){
            if($r->option1 != ""){
                $option1 = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$r->option1,
                ]);
            }
            if($r->option2 != ""){
                $option2 = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$r->option2,
                ]);
            }
            if($r->option3 != ""){
                $option3 = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$r->option3,
                ]);
            }
            if($r->option4 != ""){
                $option4 = Option::create([
                    'content_detail_id'=>$content_details->id,
                    'description'=>$r->option4,
                ]);
            }
        }

        /*
        if($r->type == "Checkbox" || $r->type == "Multiple Choice"){
            if($r->option1 != ""){
                $option1=Option::find($r->option1_id);
                $option1->description=$r->description;
                $option1->save();
            }
            if($r->option2 != ""){
                $option2=Option::find($r->option2_id);
                $option2->description=$r->description;
                $option2->save();
            }
            if($r->option3 != ""){
                $option3=Option::find($r->option3_id);
                $option3->description=$r->description;
                $option3->save();
            }
            if($r->option4 != ""){
                $option4=Option::find($r->option4_id);
                $option4->description=$r->description;
                $option4->save();
            }
        }
        */
        return redirect()->route('professional.content_detail.view',['id'=>$content_id]);
    }

}

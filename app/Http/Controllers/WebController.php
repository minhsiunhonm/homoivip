<?php

namespace App\Http\Controllers;

use App\User;
use App\modul;
use App\team;
use App\rule;
use App\follow;
use App\question;
use App\project;
use App\reviews;
use Input,File;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests\taoduan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
class WebController extends Controller
{
    //
    public function index()
    {
        $idselect = 1;
        $project = \App\project::with('users')->where('hidden','0')->where('status','>',$idselect)->paginate(12);
        $status = DB::table('status')->get();
        $dem = 0; 
        if (Auth::check()) {
            $demtb= DB::table('note')->where('status','0')->where('id_user',Auth::user()->id)->count();
        }else{
            $demtb = [];
        }
        return view('index',['project'=>$project,'status'=>$status,'demtb'=>$demtb]);
    }
    public function chitiet()
    {
    	return view('chitiet');
    }
    public function project($id)
    {
        $modul = DB::table('modul')->where('id_project',$id)->orderBy('vitri','desc')->get();
        $project = DB::table('project')->where('id',$id)->get();
        $progress= DB::table('progress')->where('id_project',$id)->orderBy('date', 'ASC')->get();
        if (Auth::check()) {
            $note = DB::table('team')->where('id_user',Auth::user()->id)->where('id_project',$id)->where('agree','0')->where('rule','sv')->where('rule','gt')->get();
            $team = DB::table('team')->where('id_user',Auth::user()->id)->where('id_project',$id)->get();
            $demtb= DB::table('note')->where('status','0')->where('id_user',Auth::user()->id)->count();
            $checkmember = DB::table('team')->where('id_project',$id)->where('hidden','0')->where('agree','1')->where('id_user',Auth::user()->id)->count();
            if(Auth::user()->rule == 6){
                $checkmember = DB::table('invest')->where('id_project',$id)->where('id_user',Auth::user()->id)->where('status',2)->count();
            }
        }else{
            $demtb='';
            $checkmember=0;
            $note=[];
        	$team= array();
        }
        foreach ($project as $key) {
        	$status = $key->status;
        	$hidden = $key->hidden;
        	$id_user = $key->id_user;
        }
        if (count($project) == 0 || $hidden == 1) {
            return redirect()->back();
        }
        $user = DB::table('users')->where('id',$id_user)->get();
        $invest = DB::table('invest')->where('id_project',$id)->where('money','!=',0)->where('status','!=',0)->get();
        $position = DB::table('position')->where('id_user',$id_user)->get();
        $manggate = \App\team::with('users')->where('id_project',$id)->where('hidden','0')->where('agree','1')->where('rule','gt')->select('id_user')->get();
        $mangndt = \App\invest::with('users')->where('id_project',$id)->where('money','!=',0)->get();
        $invest = DB::table('invest')->where('id_project',$id)->where('money','!=',0)->get();
        $mangsv = \App\team::with('users')->where('id_project',$id)->where('hidden','0')->where('agree','1')->where('rule','sv')->select('id_user')->get();
        $reviews = DB::table('reviews')->where('id_project',$id)->get();
        if (Auth::check()) {
            $follow = DB::table('follow')->where('id_user',Auth::user()->id)->where('id_toproject',$id)->where('code','pro')->count();
        }else{
            $follow = [];
        }
        $estimate= DB::table('estimate')->where('id_project',$id)->get();
        $countfollow = DB::table('follow')->where('id_toproject',$id)->where('code','pro')->count();
        $countdautu = DB::table('invest')->where('id_project',$id)->where('money','!=',0)->where('status','!=',0)->count();
        $countgate = DB::table('team')->where('id_project',$id)->where('hidden','0')->where('agree','1')->where('rule','gt')->count();
        $countsv = DB::table('team')->where('id_project',$id)->where('hidden','0')->where('agree','1')->where('rule','sv')->count();
        $getstart= DB::table('progress')->where('id_project',$id)->orderBy('date', 'ASC')->select('date')->limit(1)->get();
        foreach ($getstart as $key) {
            $getstart = $key->date;
        }
        $getstop= DB::table('progress')->where('id_project',$id)->orderBy('date', 'desc')->select('date')->limit(1)->get();
        foreach ($getstop as $key) {
            $getstop = $key->date;
        }
        return view('chitiet',['project'=>$project,'modul'=>$modul,'user'=>$user,'position'=>$position,'demtb'=>$demtb,'manggate'=>$manggate,'progress'=>$progress,'id'=>$id,'note'=>$note,'team'=>$team,'invest'=>$invest,'mangndt'=>$mangndt,'mangsv'=>$mangsv,'reviews'=>$reviews,'checkmember'=>$checkmember,'follow'=>$follow,'estimate'=>$estimate,'countfollow'=>$countfollow,'countdautu'=>$countdautu,'countgate'=>$countgate,'countsv'=>$countsv,'getstart'=>$getstart,'getstop'=>$getstop]);
    }
}

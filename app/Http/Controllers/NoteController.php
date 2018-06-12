<?php

namespace App\Http\Controllers;

use App\rule;
use App\note;
use App\User;
use App\team;
use App\modul;
use App\project;
use App\position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class NoteController extends Controller
{
    //
    public function moithanhvien(Request $rq)
    {
        if($rq->ajax()){
            $gettime = rand().time();
            $id_project = addslashes($rq->idproject);
            $id = addslashes($rq->id);
            if (Auth::check()) {
                $project = DB::table('project')->where('id',$id_project)->get();
                foreach ($project as $key) {
                    $id_user = $key->id_user;
                }
                if (Auth::user()->rule != '1' ) {
                    if($id_user != Auth::user()->id){
                        return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
                    }
                }
                if (count($project) == 1) {
                    $demteam = DB::table('team')->where('id_user',$id)->where('id_project',$id_project)->count();
                    if ($demteam == 1) {
                        return 'loithem';
                    }
                    $note = new note();
                    $note->code = 'moisv';
                    $note->id_pick = Auth::user()->id;
                    $note->id_project = $id_project;
                    $note->id_user = $id;
                    $note->hidden = '0';
                    $note->name = '';
                    $note->status = '0';
                    $note->save();
                    $team = new team();
                    $team->id_user = $id;
                    $team->id_project = $id_project;
                    $team->hidden = '0';
                    $team->agree = '0';
                    $team->rule = 'sv';
                    $team->save();
                    $team = \App\team::with('users')->where('id_project',$id_project)->where('agree','<','3')->where('rule','sv')->limit(5)->get(); 
                    //
                    return view('duan.loadajax.tablesinhvien',['teamsv'=>$team,'ok'=>'1','gettime'=>$gettime,'id'=>$id_project]);
                }
            }
        }
    }
    public function moigate(Request $rq)
    {
        if ($rq->ajax()) {
            $gettime = rand().time();
            $id_project = addslashes($rq->idproject);
            $id = addslashes($rq->id);
            if (Auth::check()) {
                $project = DB::table('project')->where('id',$id_project)->get();
                foreach ($project as $key) {
                    $id_user = $key->id_user;
                }
                if (Auth::user()->rule != '1' ) {
                    if($id_user != Auth::user()->id){
                        return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
                    }
                }
                if (count($project) == 1) {
                    $demteam = DB::table('team')->where('id_user',$id)->where('id_project',$id_project)->count();
                    if ($demteam == 1) { 
                        return 'loithem';
                    }
                    $note = new note();
                    $note->code = 'moigt';
                    $note->id_pick = Auth::user()->id;
                    $note->id_project = $id_project;
                    $note->id_user = $id;
                    $note->hidden = '0';
                    $note->name = '';
                    $note->status = '0';
                    $note->save();
                    $team = new team();
                    $team->id_user = $id;
                    $team->id_project = $id_project;
                    $team->hidden = '0';
                    $team->agree = '0';
                    $team->rule = 'gt';
                    $team->save();

                    $team = \App\team::with('users')->where('id_project',$id_project)->where('agree','<','3')->where('rule','gt')->limit(5)->get(); 
                    //
                    return view('duan.loadajax.tablegate',['teamgt'=>$team,'ok'=>'1','gettime'=>$gettime,'id'=>$id_project]);
                }
            }
            return '';
        }
    }
    public function getRequestgate(Request $rq)
    {
        $search = addslashes($rq->getdata);
        if (Auth::check() && $rq->ajax()) {
            if ($search != '') {
                if (is_numeric($search)) {
                    $users = \App\User::with('position')->select('name','id','linkprofile','avatar')->where('id','!=',Auth::user()->id)->where('phone',"$search")->where('rule',7)->limit('5')->get();
                }else{ 
                    //name
                    $users = \App\User::with('position')->select('name','id','linkprofile','avatar')->where('id','!=',Auth::user()->id)->where('name','like',"%$search%")->where('rule',7)->limit('5')->get();
                }
                if (count($users) == 0) {
                    return 'khongcogi';
                }
                return view('duan.loadajax.gate',['users'=>$users]);
            }else{
                return '';
            }
        }else{
            return '';
        }
    }
    public function getRequest(Request $rq)
    {
        $search = addslashes($rq->getdata);
        if (Auth::check() && $rq->ajax()) {
            if ($search != '') {
                if (is_numeric($search)) {
                    $users = \App\User::with('position')->select('name','id','linkprofile','avatar')->where('id','!=',Auth::user()->id)->where('phone',"$search")->where('rule',8)->limit('5')->get();
                }else{ 
                    //name
                    $users = \App\User::with('position')->select('name','id','linkprofile','avatar')->where('id','!=',Auth::user()->id)->where('name','like',"%$search%")->where('rule',8)->limit('5')->get();
                }
                if (count($users) == 0) {
                    return 'khongcogi';
                }
                return view('duan.loadajax.sinhvien',['users'=>$users]);
            }else{
                return '';
            }
        }else{
            return '';
        }
    }
    public function loadajaxalert(Request $rq)
    {
            $note = \App\note::with('projects')->where('id_user',Auth::user()->id)->orderBy('id','desc')->take(10)->get();
            return view('ajax.alert',['note'=>$note]);
    }
    public function loadajaxalerttiep(Request $rq)
    { 
        if (Auth::check() && $rq->ajax()) {
            $demsoalert = $rq->demsoalert;
            $note = DB::table('note')->where('id_user',Auth::user()->id)->orderBy('id','desc')->limit(10)->offset($demsoalert)->get();
            $getavatar = array();
            $dem = 0;
            foreach ($note as $key) {
                if($key->code == 'moisv' || $key->code == 'moigt'){
                    $getavatar[$dem]= DB::table('project')->select('id','avatar','name')->where('id',$key->id_project)->get();
                }
                $dem++;
            }
            return view('ajax.alert',['note'=>$note,'getavatar'=>$getavatar]);
        }
    }
    
}

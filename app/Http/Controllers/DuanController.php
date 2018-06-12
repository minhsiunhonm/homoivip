<?php

namespace App\Http\Controllers;

use App\User;
use App\estimate;
use App\invest;
use App\modul;
use App\team;
use App\rule;
use App\city;
use App\career;
use App\note;
use App\very;
use App\follow;
use App\progress;
use App\question;
use App\reviews;
use App\project;
use Input,File;
use Image;
use Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\taoduan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class DuanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function danhgiasv(Request $rq)
    {
        $project= DB::table('project')->where('id',$rq->id)->where('id_user',Auth::user()->id)->count();
        if (!Auth::check() && $project == 0) {
            return redirect()->back()->with('error', 'Chức năng này không dành cho bạn.');
        }
        $checkmem = DB::table('reviews')->where('id_user',$rq->sv)->where('id_gatepro', Auth::user()->id)->count();
        if ($checkmem != 0) {
            return redirect()->back()->with('error', 'Bạn đã đánh giá tài khoản này rồi');
        }
        $rq->validate([
            'id'   => 'required',
            'sv' => 'required',
            'noidung' => 'required',
            'skill'=> 'required',
            'knowledge'=> 'required',
            'attitude'=> 'required',
        ]); 
        $reviews = new reviews();
        $reviews->id_user = $rq->sv;
        $reviews->id_project = $rq->id;
        $reviews->id_gatepro = Auth::user()->id;
        $reviews->comment = $rq->noidung;
        $reviews->skill = $rq->skill;
        $reviews->knowledge = $rq->knowledge;
        $reviews->attitude = $rq->attitude;
        $reviews->leve = 'sv';
        $reviews->save();
        return redirect()->back()->with('danhgia','Thêm đánh giá thành công.');
    }
    public function danhgiandt(Request $rq)
    {
        $project= DB::table('project')->where('id',$rq->id)->where('id_user',Auth::user()->id)->count();
        if (!Auth::check() && $project == 0) {
            return redirect()->back()->with('error', 'Chức năng này không dành cho bạn.');
        }
        $checkmem = DB::table('reviews')->where('id_user',$rq->ndt)->where('id_gatepro', Auth::user()->id)->count();
        if ($checkmem != 0) {
            return redirect()->back()->with('error', 'Bạn đã đánh giá tài khoản này rồi');
        }
        $rq->validate([
            'id'   => 'required',
            'ndt' => 'required',
            'noidung' => 'required',
        ]); 
        $reviews = new reviews();
        $reviews->id_user = $rq->ndt;
        $reviews->id_project = $rq->id;
        $reviews->id_gatepro = Auth::user()->id;
        $reviews->comment = $rq->noidung;
        $reviews->leve = 'ndt';
        $reviews->save();
        return redirect()->back()->with('danhgia','Thêm đánh giá thành công.');
    }
    public function danhgiagate(Request $rq)
    {
        $project= DB::table('project')->where('id',$rq->id)->where('id_user',Auth::user()->id)->count();
        if (!Auth::check() && $project == 0) {
            return redirect()->back();
        }
        $checkmem = DB::table('reviews')->where('id_gatepro',$rq->gate)->where('id_user', Auth::user()->id)->count();
        if ($checkmem != 0) {
            return redirect()->back()->with('error', 'Bạn đã đánh giá tài khoản này rồi');
        }
        $rq->validate([
            'id'   => 'required',
            'gate' => 'required',
            'noidung' => 'required',
            'star'=> 'required'
        ]); 
        $reviews = new reviews();
        $reviews->rate = $rq->star;
        $reviews->id_user = Auth::user()->id;
        $reviews->id_project = $rq->id;
        $reviews->id_gatepro = $rq->gate;
        $reviews->comment = $rq->noidung;
        $reviews->leve = 'gate';
        $reviews->save();
        return redirect()->back()->with('danhgia','Thêm đánh giá thành công.');
    }
    public function taoduan(taoduan $rq)
    {
        if (Auth::user()->rule < 6) {
            return redirect()->back()->with('message2', 'Chức năng này không dành cho admin.');
        }
    	if (Auth::user()->very != 1 && Auth::user()->verymail != 1) {
    		return redirect()->back()->with('message2', 'Tài khoản của bạn chưa được sác minh.');
    	}
        $project = DB::table('project')->where('hidden',0)->where('id_user',Auth::user()->id)->get();
        if (Auth::user()->rule == 8) {
        	if (count($project) > 0) { /// note chuyển về 1 -> 0
	    		return redirect()->back()->with('message2', 'Bạn được tạo tối đa 0 dự án.');
        	}
        }if (Auth::user()->rule == 7) {
        	if (count($project) > 1) {
	    		return redirect()->back()->with('message2', 'Bạn được tạo tối đa hai dự án.');
        	}
        }if (Auth::user()->rule == 6) {
            return redirect()->back();
            if (count($project) > 2) {
                return redirect()->back()->with('message2', 'Bạn được tạo tối đa ba dự án.');
        	}
        } 
    	$name = $rq->tenduan;
        if ($rq->hasFile('myfile')) {
            $file = $rq->file('myfile');
            $fileName = $file -> getClientOriginalName('myfile');
            $fileName = str_slug($fileName, '-');
            $fileName = $fileName.'.'.$file -> getClientOriginalExtension('myfile');
            $t=time();
            $a =  $t.'_'.$fileName;
            $file->move('public/fileupload',$a);
            $doiten = 'public/fileupload/'.$a;
            $img = Image::make($doiten)->resize(300, 300)->save($doiten);
            $project = new project(); 
	        $project->id_user = Auth::user()->id;
	        $project->name = $rq->tenduan;
	        $project->avatar = $a;
	        $project->banner = 'banner.png';
	        $project->short_description = $rq->motangan;
	        $project->place = $rq->adress;
	        $project->money = $rq->money;
	        $project->video_slide	 = '';
	        $project->hidden = '0';
	        $project->status = '1';
	        $project->save(); 
	        $lastid =  DB::getPdo()->lastInsertId();
        }else{
        	$project = new project(); 
	        $project->id_user = Auth::user()->id;
	        $project->name = $rq->tenduan;
	        $project->avatar = 'logo.png';
	        $project->banner = 'banner.png';
	        $project->short_description = $rq->motangan;
	        $project->place = $rq->adress;
	        $project->money = $rq->money;
	        $project->video_slide	 = '';
	        $project->hidden = '0';
	        $project->status = '1';
	        $project->save(); 
	        $lastid =  DB::getPdo()->lastInsertId();
        }
        $follow= DB::table('follow')->where('code','mem')->where('id_touser',Auth::user()->id)->select('id_user')->get();
        foreach ($follow as $key) {
            $note = new note();
            $note->code = 'flmem';
            $note->id_user = $key->id_user;
            $note->id_pick = Auth::user()->id;
            $note->id_project = $lastid;
            $note->hidden = '0';
            $note->status = '0';
            $note->name = Auth::user()->name;
            $note->save();
        }
        return redirect()->route('duan');
    }
    public function viewtaoduan()
    {
        $demtb= DB::table('note')->where('status','0')->where('id_user',Auth::user()->id)->count();
    	return view('duan.taoduan',['demtb'=>$demtb]);
    }
    public function duan()
    {

        $demtb= DB::table('note')->where('status','0')->where('id_user',Auth::user()->id)->count();
        $project = DB::table('project')->where('hidden','0')->where('id_user',Auth::user()->id)->get();
        $demthamgia = \App\team::with('project')->where('rule','yc')->select('id_project')->get();
    	return view('duan.duan',['project'=>$project,'demtb'=>$demtb,'demthamgia'=>$demthamgia]);
    }
    public function suathongtincoban($id)
    {
        $project = DB::table('project')->where('hidden','0')->where('id',$id)->get();
        foreach ($project as $key) {
            $status = $key->status;
            $id_user = $key->id_user;
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
                return redirect()->back();
            }
        }
        $demyctg = DB::table('team')->where('id_project',$id)->where('agree','0')->where('rule','yc')->count();
        $modul = DB::table('modul')->where('id_project',$id)->orderBy('vitri','desc')->get();
        $demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
        $progress= DB::table('progress')->where('id_project',$id)->orderBy('date', 'ASC')->get();
        return view('duan.suathongtincoban',['modul'=>$modul,'id'=>$id,'progress'=>$progress,'project'=>$project,'demtb'=>$demtb,'status'=>$status,'demyctg'=>$demyctg]);
    }
    public function modulgioithieu(Request $rq, $id)
    {
        $project = DB::table('project')->where('hidden','0')->where('id',$id)->get();
        foreach ($project as $key) {
            $status = $key->status;
            $id_user = $key->id_user;
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
                return redirect()->back();
            }
        }
        $modul = DB::table('modul')->where('id_project',$id)->orderBy('vitri','desc')->get();
        return view('duan.modulgioithieu',['id'=>$id,'status'=>$status,'modul'=>$modul]);
    }
    public function suathongtincobanduan(Request $rq, $id)
    {
        if($rq->ajax()){
            $project = DB::table('project')->where('hidden','0')->where('id',$id)->get();
            $career = DB::table('career')->get();
            $city = DB::table('city')->get();
            foreach ($project as $key) {
                $status = $key->status;
                $id_user = $key->id_user;
            }
            if (Auth::user()->rule != '1' ) {
                if($id_user != Auth::user()->id){
                    return redirect()->back();
                }
            }
            return view('duan.suathongtincobanduan',['project'=>$project,'status'=>$status,'id'=>$id,'career'=>$career,'city'=>$city]);
        }
    }
    public function bangdutoan(Request $rq, $id)
    {
        if($rq->ajax()){
            $project = DB::table('project')->where('hidden','0')->where('id',$id)->get();
            foreach ($project as $key) {
                $status = $key->status;
                $id_user = $key->id_user;
            }
            if (Auth::user()->rule != '1' ) {
                if($id_user != Auth::user()->id){
                    return redirect()->back();
                }
            }
            $estimate= DB::table('estimate')->where('id_project',$id)->get();
            return view('duan.bangdutoan',['id'=>$id,'status'=>$status,'estimate'=>$estimate]);
        }
    }
    public function tiendoduandera(Request $rq, $id)
    {
        if($rq->ajax()){
            $project = DB::table('project')->where('hidden','0')->where('id',$id)->get();
            foreach ($project as $key) {
                $status = $key->status;
                $id_user = $key->id_user;
            }
            if (Auth::user()->rule != '1' ) {
                if($id_user != Auth::user()->id){
                    return redirect()->back();
                }
            }
            $progress= DB::table('progress')->where('id_project',$id)->orderBy('date', 'ASC')->get();
            return view('duan.tiendoduandera',['id'=>$id,'progress'=>$progress,'status'=>$status]);
        }
    }
    public function suattcoban(taoduan $rq)
    {
        $project = DB::table('project')->where('hidden','0')->where('id',$rq->id)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
            $status = $key->status;
        }
        if ($status > 1 && $status < 5) {
            return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
                return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
            }
        }
        project::where('id', $rq->id)
            ->update([
            'name' => $rq->tenduan,
            'short_description' => $rq->motangan,
            'id_career' => $rq->nganhnghe,
            'id_city' => $rq->city,
            // 'money' => $rq->money,
            'tag' => $rq->tag,
        ]);
        return redirect()->back();
    }
    public function themmodul(Request $rq)
    {
        $project = DB::table('project')->where('id',$rq->id)->get();
        if (count($project) != 1) {
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#modulgioithieu');
        }
        foreach ($project as $key) {
            $id_user = $key->id_user;
            $status = $key->status;
        }
        if($status > 1 && $status < 5){
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#modulgioithieu');
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#modulgioithieu');
            }
        }
        $modul = DB::table('modul')->where('id_project',$rq->id)->count();
        if ($modul > 19) {
            return redirect()->back()->with('error', 'Quá giới hạn 20 modul.');
        }
        if ($rq->giaodien == 'chitieukpi' || $rq->giaodien == 'videoyoutube' ||$rq->giaodien == 'slideshare') {
            if ($rq->tenmodul == null || $rq->giatrihtml == null) {
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#modulgioithieu');
            }
            $demmodul = $modul+1;
            $modul = new modul(); 
            $modul->name = $rq->tenmodul;
            $modul->id_project = $rq->id;
            $modul->content = $rq->giatrihtml;
            $modul->vitri = $demmodul;
            $modul->save(); 
        }elseif ($rq->giaodien == '' || $rq->giaodien == 'tuychinh') {
            if ($rq->tenmodul == null || $rq->noidung == null) {
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#modulgioithieu');
            }
            $demmodul = $modul+1;
            $modul = new modul(); 
            $modul->name = $rq->tenmodul;
            $modul->id_project = $rq->id;
            $modul->content = $rq->noidung;
            $modul->vitri = $demmodul;
            $modul->save(); 
        }
        return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#modulgioithieu');
    }
    public function lenmodul($id)
    {
        $modul = DB::table('modul')->where('id',$id)->select('vitri','id_project')->get();
        if (count($modul) != 1) {
            return redirect()->back();
        }
        foreach ($modul as $key) {
            $vitri = $key->vitri;
            $id_project = $key->id_project;
        }
        $demmodul = DB::table('modul')->where('id_project',$id_project)->count();
        if ($demmodul == $vitri) {
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
        }else{
            modul::where('vitri', $vitri+1)
                ->update([
                'vitri' => $vitri,
            ]);
            modul::where('id', $id)
                ->update([
                'vitri' => $vitri+1,
            ]);
        }
        return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
    }
    public function xuongmodul($id)
    {
        $modul = DB::table('modul')->where('id',$id)->select('vitri','id_project')->get();
        if (count($modul) != 1) {
            return redirect()->back();
        }
        foreach ($modul as $key) {
            $vitri = $key->vitri;
            $id_project = $key->id_project;
        }
        if ($vitri == 1) {
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
        }else{
            modul::where('vitri', $vitri-1)
                ->update([
                'vitri' => $vitri,
            ]);
            modul::where('id', $id)
                ->update([
                'vitri' => $vitri-1,
            ]);
        }
        return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
    }
    public function xoamodul($id)
    {
        $modul = DB::table('modul')->where('id',$id)->select('vitri','id_project')->get();
        foreach ($modul as $key) {
            $vitri = $key->vitri;
            $id_project = $key->id_project;
        }
        $project = DB::table('project')->where('id',$id_project)->select('id_user','status')->get();
        foreach ($project as $key) {
            $getiduser = $key->id_user;
            $status = $key->status;
        }
        if ($status > 1 && $status <5) {
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
        }
        if ($getiduser == Auth::user()->id || Auth::user()->rule == '1') {
            $demmodul = DB::table('modul')->where('id_project',$id_project)->count();
            if ($demmodul == $vitri) {
                DB::table('modul')->where('id',$id)->delete();
            }else{
                DB::table('modul')->where('id',$id)->delete();
                for ($i=$vitri+1; $i < $demmodul+1; $i++) { 
                    DB::table('modul')->where('id_project',$id_project)->where('vitri',$i)
                        ->update([
                        'vitri' => $i-1,
                    ]);
                }
            }
        }
        return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
    }
    public function suamodul($id)
    {
        $modul = DB::table('modul')->where('id',$id)->get();
        if (count($modul) != 1) {
            return redirect()->back();
        }
        foreach ($modul as $key) {
            $id_project = $key->id_project;
        }
        $demtb= DB::table('note')->where('status','0')->where('id_user',Auth::user()->id)->count();
        return view('duan.suamodul',['modul'=>$modul,'id'=>$id,'demtb'=>$demtb,'id_project'=>$id_project]);
    }
    public function suamoduls(Request $rq)
    {
        $modul = DB::table('modul')->where('id',$rq->id)->select('id_project')->get();
        if (count($modul) != 1) {
            return redirect()->back();
        }
        foreach ($modul as $key) {
            $id_project = $key->id_project;
        }
        $project = DB::table('project')->select('id_user','status')->where('id',$id_project)->get();
        if (count($project) != 1) {
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
        }
        foreach ($project as $key) {
            $id_user = $key->id_user;
            $status = $key->status;
        }
        if($status > 1 && $status < 5){
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
                return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
            }
        }
        modul::where('id', $rq->id)
            ->update([
            'name' => $rq->tenmodul,
            'content' => $rq->noidung,
        ]);
        return redirect(route('suathongtincoban', ['id' => $id_project]) . '#modulgioithieu');
    }
    public function thayvideo(Request $rq)
    {
        if ($rq->video_slide == '') {
            return redirect()->back()->with('message2', '.');
        }
        $project = DB::table('project')->where('id',$rq->id)->get();
        if (count($project) != 1) {
            return redirect()->back()->with('message2', 'Lỗi.');
        }
        foreach ($project as $key) {
            $id_user = $key->id_user;
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
                return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
            }
        }
        project::where('id', $rq->id)
            ->update([
            'video_slide' => $rq->video_slide,
        ]);
        return redirect()->back();
    }
    public function thayavatar(Request $rq)
    {
        $id = $rq->id;
        $project = DB::table('project')->where('id',$id)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
                return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
            }
        }
        if ($rq->hasFile('myfile')) {
            $file = $rq->file('myfile');
            $project = DB::table('project')->select('avatar')->where('id',$id)->get();
            foreach ($project as $key) {
                $a = $key->avatar;
            }
            if ($a != 'user2-160x160.jpg') {
                File::delete('public/fileupload/'.$a);
            }
            $fileName = $file -> getClientOriginalName('myfile');
            $fileName = str_slug($fileName, '-');
            $fileName = $fileName.'.'.$file -> getClientOriginalExtension('myfile');
            $t=time();
            $a =  $t.'_'.$fileName;
            $file->move('public/fileupload',$a);
            $doiten = 'public/fileupload/'.$a;
            $img = Image::make($doiten)->resize(300, 300)->save($doiten);
            project::where('id', $id)
                ->update([
                'avatar' => $a,
            ]);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    public function thaybanner(Request $rq)
    {
        $id = $rq->id;
        $project = DB::table('project')->where('id',$id)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
                return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
            }
        }
        if ($rq->hasFile('myfile')) {
            $file = $rq->file('myfile');
            $project = DB::table('project')->select('banner')->where('id',$id)->get();
            foreach ($project as $key) {
                $a = $key->banner;
            }
            if ($a != 'user2-160x160.jpg') {
                File::delete('public/fileupload/'.$a);
            }
            $fileName = $file -> getClientOriginalName('myfile');
            $fileName = str_slug($fileName, '-');
            $fileName = $fileName.'.'.$file -> getClientOriginalExtension('myfile');
            $t=time();
            $a =  $t.'_'.$fileName;
            $file->move('public/fileupload',$a);
            $doiten = 'public/fileupload/'.$a;
            project::where('id', $id)
                ->update([
                'banner' => $a,
            ]);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    public function yeucauthamgia(Request $rq,$id)
    {
        if($rq->ajax()){
            $project = DB::table('project')->select('thamgia','id_user')->where('id',$id)->get();
            foreach ($project as $key) {
                $id_user = $key->id_user;
                $thamgia = $key->thamgia;
            }
            if(Auth::user()->rule != 1){
                if ($id_user != Auth::user()->id) {
                    return redirect()->back();
                }
            }
            $question = DB::table('question')->where('id_project',$id)->where('code','cauhoi')->get();
            return view('duan.yeucauthamgia',['id'=>$id,'thamgia'=>$thamgia,'question'=>$question]);
        }
    }
    public function thanhvienyeucau(Request $rq,$id)
    {
        if($rq->ajax()){
            $team = \App\team::with('users')->where('id_project',$id)->where('agree','0')->where('rule','yc')->get();
            return view('duan.thanhvienyeucau',['team'=>$team]);
        }
    }
    public function dautu(Request $rq,$id)
    {
        if($rq->ajax()){
            $project = DB::table('project')->where('id',$id)->select('money','min_money','status','id_user')->get();
            foreach ($project as $key) {
                $id_user = $key->id_user;
                $money = $key->money;
                $min_money = $key->min_money;
                $status = $key->status;
            }
            if(Auth::user()->rule != 1){
                if ($id_user != Auth::user()->id) {
                    return redirect()->back();
                }
            }
            if ($min_money <1000000) {
                $min_money = 1000000;
            }
            $invest = \App\invest::with('users')->where('id_project',$id)->where('status','!=',0)->get();
            return view('duan.dautu',['id'=>$id,'money'=>$money,'min_money'=>$min_money,'status'=>$status,'invest'=>$invest]);
        }
    }
    public function themcauhoi(Request $rq)
    {
        if ($rq->chophep < 1) {
            project::where('id', $rq->id)
                ->update([
                'thamgia' => '0',
            ]);
        }else{
            project::where('id', $rq->id)
                ->update([
                'thamgia' => '1',
            ]);
            $question = DB::table('question')->where('id_project',$rq->id)->where('code','cauhoi')->count();
            for ($i=1; $i < $question+1; $i++) { 
                $namech = 'cauhoi'.$i;
                question::where('id_project', $rq->id)->where('code','cauhoi')->where('stt',$i)
                    ->update([
                    'question' => $rq->$namech,
                ]);
            }
            for ($i=$question+1; $i < 11; $i++) { 
                $namech = 'cauhoi'.$i;
                if ($rq->has($namech)) {
                    $question = new question();
                    $question->id_project = $rq->id;
                    $question->code = 'cauhoi';
                    $question->stt = $i;
                    $question->question = $rq->$namech;
                    $question->save();
                }
            }
        }
        return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#yeucauthamgia');
    }
    public function pheduyetduan(Request $rq)
    {
        $date = date('Y-m-d', time());
        $getdate = date('Y-m-d', time());
        $project = DB::table('project')->select('status','thamgia','ngaybatdau','ngayketthuc')->where('id',$rq->id)->get();
        foreach ($project as $key) {
            $status = $key->status;
            $thamgia = $key->thamgia;
            $ngaybatdau = $key->ngaybatdau;
            $ngayketthuc = $key->ngayketthuc;
        }
        if ($status != 1 && $thamgia != 2) {
            DB::table('team')->where('id_project',$rq->id)->where('agree','0')->delete();
            project::where('id',$rq->id)
                ->update([
                'thamgia' => 2,
            ]);
        }
        $date1=date_create($getdate);
        $progress = DB::table('progress')->select('date')->orderBy('date','desc')->where('id_project',$rq->id)->limit(1)->get();
        if (count($progress) == 0) {
            return redirect()->back()->with('error','Bạn chưa đề ra tiến độ dự án');
        }
        foreach ($progress as $key) {
            $dateprogress = $key->date;
        }
        $date1=date_create($getdate);
        $date11=date_create($dateprogress);
        $diff=date_diff($date1,$date11);
        $tongpc = $diff->format("%R%a")+0;
        if($tongpc < 0){
            return redirect()->back()->with('error', 'Lỗi! dựa theo tiến độ dự án, dự án đã được đi vào hoạt động.');
        }elseif($tongpc > 30){
            $date2=date_add($date1, date_interval_create_from_date_string('30 days'));
        }else{
            $date2 = $dateprogress;
        }
        project::where('id',$rq->id)
            ->update([
            'status' => 2,
            'ngaybatdau' => $date,
            'ngayketthuc' => $date2,
        ]);
        return redirect()->back();
    }
    public function riengtuduan(Request $rq)
    {
        $project = DB::table('project')->select('status','thamgia')->where('id',$rq->id)->get();
        foreach ($project as $key) {
            $status = $key->status;
            $thamgia = $key->thamgia;
        }
        DB::table('team')->where('id_project',$rq->id)->where('agree','0')->delete();
        project::where('id',$rq->id)
            ->update([
            'status' => 1,
            'thamgia' => 0,
            'ngaybatdau' => null,
            'ngayketthuc' => null,
        ]);
        return redirect()->back();
    }
    public function xoatiendoduan(Request $rq)
    {
        if($rq->ajax()){
            $project = DB::table('project')->select('id_user')->where('id',$rq->id)->get();
            foreach ($project as $key) {
                $id_user = $key->id_user;
            }
            if (Auth::user()->rule != 1) {
                if (Auth::user()->id != $id_user) {
                    return '';
                }
            }
            $progress = DB::table('progress')->where('id',$rq->n)->DELETE();
            $progress= DB::table('progress')->where('id_project',$rq->id)->orderBy('date', 'ASC')->get();
            return view('duan.loadajax.tabletiendoduan',['progress'=>$progress]);
        }
    }
    public function timkiemduanadmin(Request $rq)
    {
        $search = addslashes($rq->value);
        if ($search != '') {
            $project = $project = \App\project::where('name','like',"%$search%")->paginate(999999);
        }else{
            return redirect()->back();
        }
        $status = DB::table('status')->get(); 
        $driengtu = DB::table('project')->where('hidden','0')->where('status',1)->count();
        $dcongkhai = DB::table('project')->where('hidden','0')->where('status',2)->count();
        $ddth = DB::table('project')->where('hidden','0')->where('status',3)->count();
        $dhoanthanh = DB::table('project')->where('hidden','0')->where('status',4)->count();
        $dthungrac = DB::table('project')->where('hidden','1')->count();
        $dyeucaupheduyet = DB::table('project')->where('ngaybatdau','0000-01-01')->count();
        return view('admin/project',['project'=>$project,'menu'=>'project','status'=>$status,'idselect'=>'timkiem','driengtu'=>$driengtu,'dcongkhai'=>$dcongkhai,'ddth'=>$ddth,'dhoanthanh'=>$dhoanthanh,'dthungrac'=>$dthungrac,'dyeucaupheduyet'=>$dyeucaupheduyet]);

    }
    public function thanhvien(Request $rq, $id)
    {
        if($rq->ajax()){
            $team = \App\team::with('users')->where('id_project',$id)->where('agree','<','3')->where('rule','sv')->get(); 
            $teamgate = \App\team::with('users')->where('id_project',$id)->where('agree','<','3')->where('rule','gt')->get();
            $project = DB::table('project')->select('status','id_user')->where('id',$id)->get();
            foreach ($project as $key) {
                $id_user = $key->id_user;
                $status = $key->status;
            }
            if(Auth::user()->rule != 1){
                if ($id_user != Auth::user()->id) {
                    return redirect()->back();
                }
            }
            return view('duan.thanhvien',['id'=>$id,'team'=>$team,'teamgate'=>$teamgate,'status'=>$status]);
        }
    }
    public function huymoi(Request $rq)
    {
        if($rq->ajax()){
            $id = $rq->idu;
            $da = $rq->da;
            $project = DB::table('project')->where('id',$da)->select('id_user')->get();
            foreach ($project as $key) {
                $id_user = $key->id_user;
            }
            if (Auth::user()->rule != '1' ) {
                if($id_user != Auth::user()->id){
                    return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
                }
            }
            $gettime = rand().time();
            $ktteam = DB::table('team')->where('id_user',$id)->where('id_project',$da)->where('agree','0')->count();
            if ($ktteam != 0) {
                DB::table('team')->where('id_user',$id)->where('id_project',$da)->where('agree','0')->delete();
                DB::table('note')->where('id_user',$id)->where('id_project',$da)->delete();
                //
                $team = \App\team::with('users')->where('id_project',$da)->where('agree','<','3')->where('rule','sv')->limit(5)->get(); 
                return view('duan.loadajax.tablesinhvien',['teamsv'=>$team,'ok'=>'2','gettime'=>$gettime,'id'=>$da]);
            }else{
                return 'loithem';
            }
        }
    }
    public function huymoigt(Request $rq)
    {
        if($rq->ajax()){
            $id = $rq->idu;
            $da = $rq->da;
            $project = DB::table('project')->where('id',$da)->select('id_user')->get();
            foreach ($project as $key) {
                $id_user = $key->id_user;
            }
            if (Auth::user()->rule != '1' ) {
                if($id_user != Auth::user()->id){
                    return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
                }
            }
            $gettime = rand().time();
            $ktteam = DB::table('team')->where('id_user',$id)->where('id_project',$da)->where('agree','0')->count();
            if ($ktteam != 0) {
                DB::table('team')->where('id_user',$id)->where('id_project',$da)->where('agree','0')->delete();
                DB::table('note')->where('id_user',$id)->where('id_project',$da)->delete();
                //
                $team = \App\team::with('users')->where('id_project',$da)->where('agree','<','3')->where('rule','gt')->limit(5)->get(); 
                return view('duan.loadajax.tablegate',['teamgt'=>$team,'ok'=>'2','gettime'=>$gettime,'id'=>$da]);
            }else{
                return 'loithem';
            }
        }
    }
    public function xoaduan($id)
    {
        if($pr->status < 3){
            return 'chức năng này chưa hoàn thành';
            // project::where('id',$id)->where('status','<','3')->delete();
            // team::where('id_project',$id)->delete();
        }
    }
    public function caidat($id)
    {
        $project = DB::table('project')->select('id_user')->where('id',$id)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
        }
        if (Auth::user()->rule != 1) {
            if ($id_user != Auth::user()->id) {
                return redirect()->back();
            }
        }
        $demtb= DB::table('note')->where('status','0')->where('id_user',Auth::user()->id)->count();
        return view('duan.caidat',['id'=>$id,'demtb'=>$demtb]);
    }
    public function xoacauhoi(Request $rq)
    {
        $idcauhoi = $rq->idcauhoi;
        $idproject = $rq->idproject;
        $demcauhoi= DB::table('question')->where('id_project',$idproject)->count();
        DB::table('question')->where('id_project',$idproject)->where('stt',$idcauhoi)->delete();
        if ($demcauhoi != $idcauhoi) {
            for ($i=$idcauhoi+1; $i < $demcauhoi+1; $i++) { 
                question::where('id_project',$idproject)->where('stt',$i)
                    ->update([
                    'stt' => $i-1,
                ]);
            }
        }
    }
    public function themtiendo(Request $rq)
    {
        if ($rq->muctieu == '' || $rq->date == '') {
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#tiendoduandera');
        }
        $demprogress = DB::table('progress')->where('id_project',$rq->id)->count();
        if ($demprogress == 10) {
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#tiendoduandera');
        }
        $project = DB::table('project')->select('id_user','status')->where('id',$rq->id)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
            $status = $key->status;
        }
        if ($status > 1 && $status < 5) {
            return redirect()->back()->with('error', 'Bạn không được sửa dự án này.');
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
                return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#tiendoduandera');
            }
        }
        $progress = new progress();
        $progress->date = $rq->date;
        $progress->id_project = $rq->id;
        $progress->content = $rq->muctieu;
        $progress->save();
        return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#tiendoduandera');
    }
    public function suatiendo(Request $rq)
    {
        $demprogress = DB::table('progress')->select('id_project')->where('id',$rq->id)->get();
        if (count($demprogress) == 0) {
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#tiendoduandera');
        }
        foreach ($demprogress as $key) {
            $id_project =$key->id_project;
        }
        if ($rq->content == '' || $rq->date == '') {
            return redirect()->back();
        }
        $project = DB::table('project')->select('id_user','status')->where('id',$id_project)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
            $status = $key->status;
        }
        if ($status > 1 && $status < 5) {
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#tiendoduandera');
        }
        if (Auth::user()->rule != '1' ) {
            if($id_user != Auth::user()->id){
                return redirect(route('suathongtincoban', ['id' => $id_project]) . '#tiendoduandera');
            }
        }
        progress::where('id',$rq->id)
            ->update([
            'date' => $rq->date,
            'content' => $rq->content,
        ]);
        return redirect(route('suathongtincoban', ['id' => $id_project]) . '#tiendoduandera');
    }
    public function moddautu(Request $rq)
    {
        if($rq->ajax()){
            if (Auth::user()->rule != 6) {
                if (Auth::user()->rule != 1) {
                    return '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Thông báo!</h4>
                    Chức năng này chỉ dành cho doanh nghiệp, hãy liên hệ với chúng tôi để được giải quyết vấn đề của bạn!
                  </div>';
                }
            }
            $invest = DB::table('invest')->where('id_user',Auth::user()->id)->where('id_project',$rq->getdata)->count();
            if ($invest == 0) {
                $newinvest = new invest();
                $newinvest->id_user = Auth::user()->id;
                $newinvest->id_project = $rq->getdata;
                $newinvest->money = 0;
                $newinvest->status = 0; //chưa thực hiện
                $newinvest->save();
            }
            $invest = DB::table('invest')->where('id_user',Auth::user()->id)->where('id_project',$rq->getdata)->get();
            $projectinvest = DB::table('project')->select('money','min_money','minmoneyplay')->where('id',$rq->getdata)->get();
            return view('duan.hienthihoadon',['invest'=>$invest,'projectinvest'=>$projectinvest,'idpr'=>$rq->getdata]);
        }
    }
    public function taodautu(Request $rq)
    {
        if($rq->ajax()){
            $projectinvest = DB::table('project')->select('money','min_money','minmoneyplay')->where('id',$rq->idpr)->get();
            foreach ($projectinvest as $key) {
                $money = $key->money;
                $min_money = $key->min_money;
            }
            if (Auth::user()->rule == 6 ) {
                if ($money < $rq->sotenn || $rq->sotenn < $min_money) {
                    return '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Thông báo!</h4>
                    Số tiền nhập vào không đúng!
                  </div>';
                }
                $invest = DB::table('invest')->where('id_user',Auth::user()->id)->where('status','1')->count();
                if ($invest != 0) {
                    note::where('id_project',$rq->idpr)->orwhere('id_user',Auth::user()->id)->orwhere('code','chuadt')
                        ->update([
                        'status' => '0'
                    ]);
                    return '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Thông báo!</h4>
                    Bạn đang có dự án chưa chuyển tiền, Hãy liên hệ với bộ phận hỗ trợ!
                  </div>';
                }else{
                    invest::where('id_user',Auth::user()->id)->where('id_project',$rq->idpr)->where('status','0')->update([
                        'status'=>'1',
                        'money'=>$rq->sotenn,
                    ]); //đợi chuyển tiền
                    $note = new note();
                    $note->code = 'chuadt';
                    $note->id_user = Auth::user()->id;
                    $note->id_project = $rq->idpr;
                    $note->hidden = 0;
                    $note->status = 1;
                    $note->save();
                }
                $invest = DB::table('invest')->where('id_user',Auth::user()->id)->where('id_project',$rq->idpr)->get();
                return view('duan.hienthihoadon',['invest'=>$invest,'projectinvest'=>$projectinvest,'idpr'=>$rq->idpr]);
            }else{
                return '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Thông báo!</h4>
                    Chức năng này chỉ dành cho doanh nghiệp, hãy liên hệ với chúng tôi để được giải quyết vấn đề của bạn!
                  </div>';
            }
        }
    }
    public function suamoney(Request $rq)
    {
        if ($rq->money > 100000000 || $rq->minmoney > 100000000 || $rq->money < 1000000 || $rq->minmoney < 1000000){
            return redirect()->back();
        }
        $project = DB::table('project')->where('id',$rq->id)->select('status')->get();
        foreach ($project as $key) {
            $status = $key->status;
        }
        if ($status != 1) {
            return redirect()->back();
        }
        project::where('id',$rq->id)
            ->update([
            'money' => $rq->money,
            'min_money' => $rq->minmoney,
        ]);
        return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#tablorldautu');
    }
    public function dongythamgia($id)
    {
        if (Auth::check()) {
            team::where('id_user',Auth::user()->id)->where('id_project',$id)
                ->update([
                'agree' => '1',
            ]);
            return redirect()->back();
        }
    }
    public function tuchoithamgia($id)
    {
        if (Auth::check()) {
            DB::table('note')->where('id_user',Auth::user()->id)->where('id_project',$id)->delete();
            DB::table('team')->where('id_user',Auth::user()->id)->where('id_project',$id)->delete();
            
            return redirect()->back();
        }
    }
    public function thamgiaduan($id)
    {
        if (Auth::check()) {
            if (Auth::user()->rule == 8) {
                $checkteam = DB::table('team')->where('id_user',Auth::user()->id)->where('id_project',$id)->count();
                $project = DB::table('project')->where('id',$id)->select('id_user')->get();
                foreach ($project as $key) {
                    $id_user = $key->id_user;
                }
                if ($id_user == Auth::user()->id) {
                    return redirect()->back();
                }
                if ($checkteam == 0) {
                    $team = new team();
                    $team->id_user = Auth::user()->id;
                    $team->id_project = $id;
                    $team->hidden = '0';
                    $team->agree = '0';
                    $team->rule = 'yc';
                    $team->save();
                }
                return redirect()->back();
            }else{
                return 'Bạn không phải sinh viên, hãy liên hệ với người tạo dự án!';
            }
        }else{
            return redirect()->back('login');
        }
    }
    public function pheduyettvyc($id)
    {
        $getidpr = DB::table('team')->select('id_project')->where('id',$id)->get();
        foreach ($getidpr as $key) {
            $id_project = $key->id_project;
        }
        $getiduser = DB::table('project')->select('id_user')->where('id',$id_project)->get();
        foreach ($getiduser as $key2) {
            $id_user = $key2->id_user;
        }
        if ($id_user == Auth::user()->id || Auth::user()->rule == 1) { //kiểm tra quyền của chủ dự án
            team::where('id',$id)
                ->update([
                'agree' => '1',
                'rule' => 'sv',
                'created_at' => date("Y-m-d h:i:s"),
            ]);
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#thanhvienyeucau');
        }else{
            return redirect()->back();
        }
    }
    public function tuchoitvyc($id)
    {
        $getidpr = DB::table('team')->select('id_project')->where('id',$id)->get();
        foreach ($getidpr as $key) {
            $id_project = $key->id_project;
        }
        $getiduser = DB::table('project')->select('id_user')->where('id',$id_project)->get();
        foreach ($getiduser as $key2) {
            $id_user = $key2->id_user;
        }
        if ($id_user == Auth::user()->id || Auth::user()->rule == 1) { //kiểm tra quyền của chủ dự án
            $getidpr = DB::table('team')->where('id',$id)->delete();
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#thanhvienyeucau');
        }else{
            return redirect()->back();
        }
    }
    public function formdutoan(Request $rq)
    {
        $rq->validate([
            'id' => 'required',
            'khoanmuc'   => 'required', 
            'soluong' => 'required',
            'donvi'   => 'required', 
            'sotiensv' => 'required',
            'sotienkhac'   => 'required', 
        ]); 
        $project = DB::table('project')->select('id_user','status')->where('id',$rq->id)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
            $status = $key->status;
        }
        if ($status > 1) {
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#bangdutoan');
        }
        if ($id_user != Auth::user()->id) {
            return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#bangdutoan');
        }
        $estimate = new estimate();
        $estimate->id_project = $rq->id;
        $estimate->name = $rq->khoanmuc;
        $estimate->soluong = $rq->soluong;
        $estimate->donvi = $rq->donvi;
        $estimate->sotiensv = $rq->sotiensv;
        $estimate->sotienkhac = $rq->sotienkhac;
        $estimate -> save();
        return redirect(route('suathongtincoban', ['id' => $rq->id]) . '#bangdutoan');
    }
    public function xoadutoan($id)
    {
        $estimate = DB::table('estimate')->select('id_project')->where('id',$id)->get();
        foreach ($estimate as $key) {
            $id_project= $key->id_project;
        }
        $project = DB::table('project')->select('id_user','status')->where('id',$id_project)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
            $status = $key->status;
        }
        if ($status > 1) {
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#bangdutoan');
        }
        if ($id_user != Auth::user()->id) {
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#bangdutoan');
        }
        DB::table('estimate')->select('id_project')->where('id',$id)->delete();
        return redirect(route('suathongtincoban', ['id' => $id_project]) . '#bangdutoan');
    }
    public function suadutoan(Request $rq)
    {
        $estimate = DB::table('estimate')->select('id_project')->where('id',$rq->iddutoan)->get();
        foreach ($estimate as $key) {
            $id_project= $key->id_project;
        }
        $project = DB::table('project')->select('id_user','status')->where('id',$id_project)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
            $status = $key->status;
        }
        if ($status > 1) {
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#bangdutoan');
        }
        if ($id_user != Auth::user()->id) {
            return redirect(route('suathongtincoban', ['id' => $id_project]) . '#bangdutoan');
        }
        estimate::where('id',$rq->iddutoan)
            ->update([
            'id_project' => $rq->id,
            'name' => $rq->khoanmuc,
            'soluong' => $rq->soluong,
            'donvi' => $rq->donvi,
            'sotiensv' => $rq->sotiensv,
            'sotienkhac' => $rq->sotienkhac,
        ]);
        return redirect(route('suathongtincoban', ['id' => $id_project]) . '#bangdutoan');
    }
    public function guiyeucaupheduyet($id)
    {
        $project = DB::table('project')->select('id_user')->where('id',$id)->get();
        foreach ($project as $key) {
            $id_user = $key->id_user;
        }
        if ($id_user != Auth::user()->id) {
            return redirect()->back();
        }
        // return date('Y-m-d');
        project::where('id',$id)
            ->update([
            'ngaybatdau' => '0000-01-01',
        ]);
        return redirect()->back();
    }
}

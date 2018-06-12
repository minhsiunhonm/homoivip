<?php

namespace App\Http\Controllers;

use Image;
use Carbon;
use App\team;
use App\rule;
use App\city;
use App\User;
use App\note;
use App\very;
use App\modul;
use App\kpi;
use Input,File;
use App\invest;
use App\career;
use App\follow;
use App\reviews;
use App\project;
use App\estimate;
use App\progress;
use App\question;
use Illuminate\Http\Request;
use App\Http\Requests\taoduan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class EditproController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function themkpi(Request $rq)
    {
        if($rq->ajax()){
            if($rq->giatrikpi == ''){
                return 'loi';
            }
            if($rq->namekpi == 1){
                return 'loi';
            }
            $kpi = DB::table('kpi')->where('id_project',$rq->id)->count();
            if ($kpi <= 6) {
                $project = DB::table('project')->where('id',$rq->id)->select('id_user')->get();
                foreach ($project as $key) {
                    $id_user = $key->id_user;
                }
                if (Auth::user()->rule != '1' ) {
                    if($id_user != Auth::user()->id){
                        return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
                    }
                }
                $kpi = new kpi();
                $kpi->code = $rq->namekpi;
                $kpi->id_project = $rq->id;
                $kpi->giatri = $rq->giatrikpi;
                $kpi->tengoi = $rq->tengoikpi;
                $kpi->save();
                $kpi = DB::table('kpi')->where('id_project',$rq->id)->get();
                return view('duan.loadajax.kpit2',['kpi'=>$kpi]);
            }
            return $kpi;
        }
    }
    public function delekpi(Request $rq)
    {
        if($rq->ajax()){
            $kpi = DB::table('kpi')->where('id',$rq->id)->count();
            if ($kpi <= 60) {
                $project = DB::table('project')->where('id',$rq->idpr)->select('id_user')->get();
                foreach ($project as $key) {
                    $id_user = $key->id_user;
                }
                if (Auth::user()->rule != '1' ) {
                    if($id_user != Auth::user()->id){
                        return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
                    }
                }
                DB::table('kpi')->where('id',$rq->id)->where('id_project',$rq->idpr)->delete();
                $kpi = DB::table('kpi')->where('id_project',$rq->idpr)->get();
                return view('duan.loadajax.kpit2',['kpi'=>$kpi]);
            }
            return $kpi;
        }
    }
    public function step2sub(Request $rq)
    {
    	if($rq->ajax()){
	    	$project = DB::table('project')->where('hidden','0')->where('id',$rq->formData['idproject'])->where('id_user',Auth::user()->id)->count();
	    	if ($project != 1) {
	    		return 'loi';
	    	}else{
	    		$modul = DB::table('modul')->where('id_project',$rq->formData['idproject'])->where('code','tongquan')->count();
	    		if ($modul == 0) {
	    			$modul = new modul();
	    			$modul->name = 'Tổng quan';
	    			$modul->code = 'tongquan';
	    			$modul->content = $rq->formData['noidung'];
	    			$modul->id_project = $rq->formData['idproject'];
	    			$modul->save();
	    		}else{	
	    			modul::where('id_project', $rq->formData['idproject'])
			            ->update([
		            	'content' => $rq->formData['noidung'],
			        ]);
	    		}
		        if ($rq->formData['nextrq'] == 1) {
		        	return 'next';
		        }
	    	}
	    }
    }
    public function step1sub(Request $rq)
    {
		// tenduan// urlduan// tinhthanh// diadiem// nganhnghe// tukhoa// diachiemail// sodienthoai// urlweb// facebook// linkedin// twitter// nextrq// idproject// description
		if($rq->ajax()){
	    	$project = DB::table('project')->where('hidden','0')->where('id',$rq->formData['idproject'])->where('id_user',Auth::user()->id)->count();
	    	if ($project != 1) {
	    		return 'loi';
	    	}else{
	    		project::where('id', $rq->formData['idproject'])
		            ->update([
	            	'name' => $rq->formData['tenduan'],
					'url' => $rq->formData['urlduan'],
					'id_city' => $rq->formData['tinhthanh'],
					'place' => $rq->formData['diadiem'],
					'id_career' => $rq->formData['nganhnghe'],
					'tag' => $rq->formData['tukhoa'],
					'emailpro' => $rq->formData['diachiemail'],
					'phonepro' => $rq->formData['sodienthoai'],
					'webpro' => $rq->formData['urlweb'],
					'facebookpro' => $rq->formData['facebook'],
					'linkedinpro' => $rq->formData['linkedin'],
					'twitterpro' => $rq->formData['twitter'],
					'short_description' => $rq->formData['description'],
		        ]);
		        if ($rq->formData['nextrq'] == 1) {
		        	return 'next';
		        }
	    	}
	    }
    }
    public function step1($id)
    {
        $demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
        $city = DB::table('city')->select('id','name')->get();
        $career = DB::table('career')->select('id','name')->get();
    	$project = DB::table('project')->where('hidden','0')->where('id',$id)->get();
    	foreach ($project as $key) {
    		$linkvideo = $key->video;
    	}
    	$linkvideo = str_replace( 'watch?v=', 'embed/', $linkvideo ); 
    	return view('editpro.step1',['demtb'=>$demtb,'city'=>$city,'career'=>$career,'id'=>$id,'project'=>$project,'linkvideo'=>$linkvideo]);
    }
    public function checkslide(Request $rq, $id)
    {
    	$formslide = 'https://www.slideshare.net/api/oembed/2?url='.$rq->formslide.'&format=json';
		if(FALSE !== ($content = @file_get_contents($formslide))) {
		}
		else {
			return 'loi';
		}
    	$json = file_get_contents($formslide); 
    	$obj = json_decode($json);
    	$linkslide = explode('</iframe>', $obj->html);
    	$project = DB::table('project')->where('hidden','0')->where('id',$id)->get();
    	foreach ($project as $key) {
    		$id_user = $key->id_user;
    	}
    	$linkslide = $linkslide[0].'</iframe>';
    	if ($id_user == Auth::user()->id) {
    		project::where('id', $id)
	            ->update([
	            'slide' => $linkslide,
	        ]);
    	}
		return $linkslide;
    }
    public function checkvideo(Request $rq, $id)
    {
    	$rx = '~
		  ^(?:https?://)?                           # Optional protocol
		   (?:www[.])?                              # Optional sub-domain
		   (?:youtube[.]com/watch[?]v=|youtu[.]be/) # Mandatory domain name (w/ query string in .com)
		   ([^&]{11})                               # Video id of 11 characters as capture group 1
		    ~x';
		$has_match = preg_match($rx, $rq->formvideo, $matches);
		if (count($matches) == 0) {
			return 'loi';
		}
		$project = DB::table('project')->where('hidden','0')->where('id',$id)->get();
    	foreach ($project as $key) {
    		$id_user = $key->id_user;
    	}
    	if ($id_user == Auth::user()->id) {
    		project::where('id', $id)
	            ->update([
	            'video' => $rq->formvideo,
	        ]);
    	}
    	$linkvideo = str_replace( 'watch?v=', 'embed/', $rq->formvideo ); 
    	$linkvideo = '<iframe src="'.$linkvideo.'?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
    	return $linkvideo;
    }
    public function step2($id)
    {
    	$project = \App\project::with('users')->where('hidden','0')->where('id',$id)->get();
        $teamsv = \App\team::with('users')->where('id_project',$id)->where('agree','<','3')->where('rule','sv')->limit(5)->get(); 
        $teamgt = \App\team::with('users')->where('id_project',$id)->where('agree','<','3')->where('rule','gt')->limit(5)->get(); 
        foreach ($project as $key) {
            $status = $key->status;
            $id_user = $key->id_user;
        }
    	// tab tien do du an
        $progress= DB::table('progress')->where('id_project',$id)->orderBy('date', 'ASC')->get();
    	// tab du toan
        $estimate= DB::table('estimate')->where('id_project',$id)->get();
        // tab tong quan
        $tongquan= DB::table('modul')->where('id_project',$id)->where('code','tongquan')->get();
        $demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
        $position= DB::table('position')->where('id_user',$id_user)->get();
        $kpi = DB::table('kpi')->where('id_project',$id)->get();
    	return view('editpro.step2',['demtb'=>$demtb,'id'=>$id,'progress'=>$progress,'status'=>$status,'estimate'=>$estimate,'tongquan'=>$tongquan,'teamsv'=>$teamsv,'project'=>$project,'teamgt'=>$teamgt,'position'=>$position,'kpi'=>$kpi]);
    }
    public function step3($id)
    {
        $demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
    	return view('editpro.step3',['demtb'=>$demtb,'id'=>$id]);
    }
    public function step1bar($id)
    {
    	return view('editpro.step1bar',['id'=>$id]);
    }
    public function step2bar($id)
    {
    	return view('editpro.step2bar',['id'=>$id]);
    }
    public function step3bar($id)
    {
    	return view('editpro.step3bar',['id'=>$id]);
    }
    public function editpro($id)
    {
    	$demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
    	return view('editpro.editpro',['demtb'=>$demtb,'id'=>$id]);
    }
}

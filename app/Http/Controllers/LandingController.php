<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\note;
use App\very;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Input,File;
use Image;
use Carbon;
use Illuminate\Database\Eloquent\Model;

class LandingController extends Controller
{
    //
    public function gioithieu()
    {
    	if (Auth::check()) {
    		# code...
        $demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
    	}else{
    		$demtb= [];
    	}
    	return view('landing.gioithieu',['demtb'=>$demtb]);
    }
    public function verymem(Request $rq)
    {
        $checkvery = DB::table('very')->where('id_user',Auth::user()->id)->count();
        if ($rq->idget != Auth::user()->id || $checkvery != 0) {
            return redirect()->back()->with('error','Có lỗi sảy ra.');
        }
        if ($rq->code == 'sv') {
            if ($rq->hasFile('thesv')) {
                $file = $rq->file('thesv');
                $fileName = $file -> getClientOriginalName('thesv');
                $fileName = str_slug($fileName, '-');
                $fileName = $fileName.'.'.$file -> getClientOriginalExtension('thesv');
                $t=time();
                $a =  $t.rand(100,1000).'_'.$fileName; 
                $file->move('public/filevery',$a);
                $very = new very();
                $very->thesv = $a;
                $very->id_user = Auth::user()->id;
                $very->status = 0;
                $very->code = 'sv';
                $very->save();
            }else{
                return redirect()->back()->with('error','Bạn chưa điền đầy đủ yêu cầu.');
            }
        }elseif ($rq->code == 'gt') {
            if ($rq->hasFile('hdld') && $rq->hasFile('mattruoccmt') && $rq->hasFile('matsaucmt')) {
                $file = $rq->file('hdld');
                $fileName = $file -> getClientOriginalName('hdld');
                $fileName = str_slug($fileName, '-');
                $fileName = $fileName.'.'.$file -> getClientOriginalExtension('hdld');
                $t=time();
                $a =  $t.rand(100,1000).'_'.$fileName;
                $file2 = $rq->file('mattruoccmt');
                $fileName2 = $file2 -> getClientOriginalName('mattruoccmt');
                $fileName2 = str_slug($fileName2, '-');
                $fileName2 = $fileName2.'.'.$file2 -> getClientOriginalExtension('mattruoccmt');
                $t=time();
                $a2 =  $t.rand(100,1000).'_'.$fileName2;
                $file3 = $rq->file('matsaucmt');
                $fileName3 = $file3 -> getClientOriginalName('matsaucmt');
                $fileName3 = str_slug($fileName3, '-');
                $fileName3 = $fileName3.'.'.$file3 -> getClientOriginalExtension('matsaucmt');
                $t=time();
                $a3 =  $t.rand(100,1000).'_'.$fileName3;
                $rq->file('hdld')->move('public/filevery',$a);
                $rq->file('mattruoccmt')->move('public/filevery',$a2);
                $rq->file('matsaucmt')->move('public/filevery',$a3);
                $very = new very();
                $very->id_user = Auth::user()->id;
                $very->hdld = $a;
                $very->mattruoccmt = $a2;
                $very->matsaucmt = $a3;
                $very->status = 0;
                $very->code = 'gt';
                $very->save();
            }else{
                return redirect()->back()->with('error','Bạn chưa điền đầy đủ yêu cầu.');
            }
        }elseif ($rq->code == 'dn') {
            if ($rq->hasFile('giayphepdkkd') && $rq->masothue != '') {
                $file = $rq->file('giayphepdkkd');
                $fileName = $file -> getClientOriginalName('giayphepdkkd');
                $fileName = str_slug($fileName, '-');
                $fileName = $fileName.'.'.$file -> getClientOriginalExtension('giayphepdkkd');
                $t=time();
                $a =  $t.rand(100,1000).'_'.$fileName;
                $rq->file('giayphepdkkd')->move('public/filevery',$a);
                $very = new very();
                $very->id_user = Auth::user()->id;
                $very->giayphepdkkd = $a;
                $very->masothue = $rq->masothue; 
                $very->status = 0;
                $very->code = 'dn';
                $very->save();
            }else{
                return redirect()->back()->with('error','Bạn chưa điền đầy đủ yêu cầu.');
            }
        }
        return redirect()->back()->with('suc','Thành công, chúng tôi đang kiểm tra hồ sơ của bạn.');
    }
}

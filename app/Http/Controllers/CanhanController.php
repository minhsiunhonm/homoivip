<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\thongtincanhan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Image;
use Input,File;
use App\position;
use App\follow;
use Hash;
use Mail;
use App\project;
use App\rule;
use App\note;
use App\Mail\OrderShipped;


class CanhanController extends Controller
{
    public function verymailax()
    {
        $confirmation_code = time().uniqid(true);
        user::where('id',Auth::user()->id)
            ->update([
            'confirmation_code' => $confirmation_code,
        ]);
        $user = User::findOrFail(Auth::user()->id);
        Mail::to($user)->send(new OrderShipped($user));
    }
    public function verify($code)
    {
        $user = User::where('confirmation_code', $code);
        if ($user->count() > 0) {
            $userxx = DB::table('users')->where('confirmation_code', $code)->select('linkprofile')->get();
            foreach ($userxx as $key) {
                $linkprofile = $key->linkprofile;
            }
            $user->update([
                'verymail' => 1,
                'confirmation_code' => null
            ]);
            return redirect(route('canhan', ['id' => $linkprofile]))->with('suc', 'Sác thực email thành công!.');
        } else {
            return redirect()->route('index');
        }
    }
    public function canhan($id)
    {
        
        $user = DB::table('users')->where('hidden',0)->where('linkprofile',$id)->get();
        if (count($user) == 0) {
            return 'Tài khoản bị xóa hoặc không tồn tại';
        }
        foreach ($user as $key) {
            $idget =$key->id;
            $very =$key->very;
            $verymail =$key->verymail;   
            $birthday =$key->birthday;
            $phone =$key->phone;
            $address =$key->address;
            $cmt =$key->cmt;
        }
        if (Auth::check()) {
            $follow = DB::table('follow')->where('id_user',Auth::user()->id)->where('id_touser',$idget)->count();
        }else{
            $follow = [];
        }
        $positionkn = DB::table('position')->where('id_user',$idget)->where('code','kn')->get();
        $positionth = DB::table('position')->where('id_user',$idget)->where('code','th')->get();
        $positioncv = DB::table('position')->where('id_user',$idget)->where('code','cv')->get();
        if (Auth::check()) {
            $demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
            $checkvery = DB::table('very')->where('id_user',Auth::user()->id)->select('status')->get();
            if (count($checkvery) == 0) {
                $checkvery = 0;
            }else{
                foreach ($checkvery as $key) {
                    $status = $key->status;
                }
                if ($status == 0) {
                    $checkvery = 1;
                }else{
                    $checkvery = 2;
                }
            }
        }else{
            $checkvery = 0;
            $demtb = [];
        }
        if ($verymail != null && $birthday != null && $phone != null && $address != null && $cmt != null && count($positioncv) != 0  && count($positionth) != 0  && count($positionkn) != 0 ) {
            $checkve=1;
        }else{
            $checkve=0;
        }
        return view('canhan.canhan',['user' => $user,'menu'=>'cn','positioncv'=>$positioncv,'positionkn'=>$positionkn,'positionth'=>$positionth,'demtb'=>$demtb,'follow'=>$follow,'checkve'=>$checkve,'checkvery'=>$checkvery,'verymail'=>$verymail,'idget'=>$idget,'very'=>$very]);
    }
    public function thongtincanhan($id)
    {
        $user = DB::table('users')->where('hidden',0)->where('linkprofile',$id)->get();
        if (count($user) == 0) {
	    	return 'Tài khoản bị xóa hoặc không tồn tại';
        }
        foreach ($user as $key) {
            $idget =$key->id;
            $very =$key->very;
            $verymail =$key->verymail;   
            $birthday =$key->birthday;
            $phone =$key->phone;
            $address =$key->address;
        	$cmt =$key->cmt;
        }
        if ($idget != Auth::user()->id) {
	    	return 'Bạn không có quyền truy cập chức năng này.';
        }
        $positionkn = DB::table('position')->where('id_user',$idget)->where('code','kn')->get();
        $positionth = DB::table('position')->where('id_user',$idget)->where('code','th')->get();
        $positioncv = DB::table('position')->where('id_user',$idget)->where('code','cv')->get();
        if ($verymail != null && $birthday != null && $phone != null && $address != null && $cmt != null && count($positioncv) != 0  && count($positionth) != 0  && count($positionkn) != 0 ) {
            $checkve=1;
        }else{
            $checkve=0;
        }
        $demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
        $checkvery = DB::table('very')->where('id_user',Auth::user()->id)->select('status')->get();
        if (count($checkvery) == 0) {
            $checkvery = 0;
        }else{
            foreach ($checkvery as $key) {
                $status = $key->status;
            }
            if ($status == 0) {
                $checkvery = 1;
            }else{
                $checkvery = 2;
            }
        }
        return view('canhan.thongtincanhan',['idget' => $idget,'user' => $user,'menu'=>'ttcn','positionkn'=>$positionkn,'positionth'=>$positionth,'positioncv'=>$positioncv,'demtb'=>$demtb,'checkve'=>$checkve,'very'=>$very,'verymail'=>$verymail,'checkvery'=>$checkvery,'very'=>$very]);
    }
    public function suathongtincanhan(thongtincanhan $rq)
    {
        if ($rq->id != Auth::user()->id) {
            return redirect()->back()->with('message2', 'Bạn không được sửa dự án này.');
        }
        user::where('id', $rq->id)
            ->update([
            'name' => $rq->name,
            'birthday' => $rq->birthday,
            'phone' => $rq->phone,
            'address' => $rq->address,
            'cmt' => $rq->cmt,
            'gender' => $rq->gender,
        ]);
		return redirect()->back()->with('message2', 'Đổi thông tin thành công.');
    }
    public function doimatkhau($id)
    {
        $user = DB::table('users')->where('hidden',0)->where('linkprofile',$id)->get();
        foreach ($user as $key) {
            $idget =$key->id;
            $very =$key->very;
            $verymail =$key->verymail;   
            $birthday =$key->birthday;
            $phone =$key->phone;
            $address =$key->address;
            $cmt =$key->cmt;
        }
        if ($idget != Auth::user()->id) {
            return redirect()->back()->with('message2', 'Lỗi.');
        }
        $positionkn = DB::table('position')->where('id_user',$idget)->where('code','kn')->get();
        $positionth = DB::table('position')->where('id_user',$idget)->where('code','th')->get();
        $positioncv = DB::table('position')->where('id_user',$idget)->where('code','cv')->get();
        $demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
        if ($verymail != null && $birthday != null && $phone != null && $address != null && $cmt != null && count($positioncv) != 0  && count($positionth) != 0  && count($positionkn) != 0 ) {
            $checkve=1;
        }else{
            $checkve=0;
        }
        $demtb= DB::table('note')->where('id_user',Auth::user()->id)->where('status','0')->count();
        $checkvery = DB::table('very')->where('id_user',Auth::user()->id)->select('status')->get();
        if (count($checkvery) == 0) {
            $checkvery = 0;
        }else{
            foreach ($checkvery as $key) {
                $status = $key->status;
            }
            if ($status == 0) {
                $checkvery = 1;
            }else{
                $checkvery = 2;
            }
        }
    	return view('canhan.doimatkhau',['user' => $user,'menu'=>'dmk','id'=>$id,'positionkn'=>$positionkn,'positioncv'=>$positioncv,'positionth'=>$positionth,'demtb'=>$demtb,'checkve'=>$checkve,'checkvery'=>$checkvery,'verymail'=>$verymail,'idget'=>$idget,'very'=>$very]);
    }
    public function doimatkhaus(Request $request)
    {
    	if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Mật khẩu cũ không khớp với mật khẩu bạn cung cấp. Vui lòng thử lại.");
        }
 
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Mật khẩu mới không được giống với mật khẩu hiện tại của bạn. Vui lòng chọn một mật khẩu khác.");
        }
 
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
        ]);
 		if ($request->get('new-password') != $request->get('new-password-confirm')) {
            return redirect()->back()->with("error","Mật khẩu nhập lại không đúng");
 		}
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Đổi mật khẩu thành công
        	!");
    }
    public function themkynang(Request $rq)
    {
        if (Auth::user()->id != $rq->id) {
            return redirect()->back();
        }
        $position = new position();
        $position->id_user = Auth::user()->id;
        $position->code = 'kn';
        $position->name = $rq->kynang;
        $position->company = '';
        $position->hidden = 0;
        $position->save();
        return redirect()->back()->with("success","Thêm Trường học thành công!");
    }
    public function themcongviec(Request $rq)
    {
        if (Auth::user()->id != $rq->id) {
        	return redirect()->back();
        }
        $position = new position();
        $position->id_user = Auth::user()->id;
        $position->code = 'cv';
        $position->name = $rq->chucvu;
        $position->company = $rq->congty;
        $position->hidden = 0;
        $position->save();
        return redirect()->back()->with("success","Thêm Trường học thành công!");
    }
    public function themtruonghoc(Request $rq)
    {
        if (Auth::user()->id != $rq->id) {
        	return redirect()->back();
        }
        $position = new position();
        $position->id_user = Auth::user()->id;
        $position->code = 'th';
        $position->name = $rq->truonghoc;
        $position->company = $rq->ngaynhaphoc;
        $position->hidden = 0;
        $position->save();
        return redirect()->back()->with("success","Thêm kỹ năng thành công!");
    }
    public function xoakynang(Request $rq)
    {
        $position = DB::table('position')->where('id',$rq->id)->where('id_user',Auth::user()->id)->count();
        if ($position == 0) {
	        return redirect()->back()->with("error","Sảy ra lỗi!");
        }
        DB::table('position')->where('id',$rq->id)->delete();
        return redirect()->back()->with("success","Xóa kỹ năng thành công!");
    }
    public function xoatruonghoc(Request $rq)
    {
        $position = DB::table('position')->where('id',$rq->id)->where('id_user',Auth::user()->id)->count();
        if ($position == 0) {
	        return redirect()->back()->with("error","Sảy ra lỗi!");
        }
        DB::table('position')->where('id',$rq->id)->delete();
        return redirect()->back()->with("success","Xóa thành công!");
    }
    public function follow(Request $rq)
    {
        if (Auth::check() && $rq->ajax()) {
            if ($rq->thispro == 1) {
                $follow = DB::table('follow')->where('id_user',Auth::user()->id)->where('id_toproject',$rq->iddata)->where('code','pro')->count();
                if ($follow == 0) {
                    $follow = new follow();
                    $follow->id_user = Auth::user()->id;
                    $follow->id_toproject = $rq->iddata;
                    $follow->code = 'pro';
                    $follow->save();
                    return '0';
                }else{
                    DB::table('follow')->where('id_user',Auth::user()->id)->where('id_toproject',$rq->iddata)->where('code','pro')->delete();
                    return '1';
                }
            }else{
                $follow = DB::table('follow')->where('id_user',Auth::user()->id)->where('id_touser',$rq->iddata)->where('code','mem')->count();
                if ($follow == 0) {
                    $follow = new follow();
                    $follow->id_user = Auth::user()->id;
                    $follow->id_touser = $rq->iddata;
                    $follow->code = 'mem';
                    $follow->save();
                    return '0';
                }else{
                    DB::table('follow')->where('id_user',Auth::user()->id)->where('id_touser',$rq->iddata)->where('code','mem')->delete();
                    return '1';
                }
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use Input,File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Image;
use App\User;
use App\project;
use App\rule;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $userqt = DB::table('users')->where('rule','<=','5')->get();
        $doanhnghiep = DB::table('users')->where('rule','=','6')->get();
        $gatekeeper = DB::table('users')->where('rule','=','7')->get();
        $sinhvien = DB::table('users')->where('rule','=','8')->get();
        return view('admin.member',['userqt'=>$userqt,'doanhnghiep'=>$doanhnghiep,'gatekeeper'=>$gatekeeper,'sinhvien'=>$sinhvien,'menu'=>'member']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $chucvu = DB::table('rule')->where('id','>','1')->where('id','<=','5')->orderBy('id', 'desc')->get();
        return view('admin.createmember',['chucvu'=>$chucvu,'menu'=>'member']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        $usercheck = DB::table('users')->where('email',$rq->email)->get();
        if (count($usercheck) > 0) {
            return redirect()->back()->with('message', 'Email đã tồn tại.');
        }elseif($rq->email == ''){
            return redirect()->back()->with('message', 'Tạo tài khoản không thành công.');
        }
        $users = new user(); 
        $users->rule = $rq->chucvu;
        $users->hidden = '0';
        $users->very = '0';
        $users->name = $rq->hoten;
        $users->avatar = 'logo.png';
        $users->linkprofile = time();
        $users->email = $rq->email;
        $users->password = bcrypt($rq->password);
        $users->gender = $rq->gioitinh;
        $users->save(); 
        return redirect()->route('member.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')->where('linkprofile',$id)->get();
        foreach ($user as $key) {
            $idcheck=$key->id;
        }
        $chucvu = DB::table('rule')->get();
        return view('admin.profile',['user'=>$user,'chucvu'=>$chucvu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')->where('id',$id)->get();
        $chucvu = DB::table('rule')->get();
        return view('admin.editmember',['user'=>$user,'chucvu'=>$chucvu,'id'=>$id,'menu'=>'member']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        if (Auth::user()->rule > 2) {
            # code...
            return redirect()->back();
        }
        if ($request->chucvu < 2) {
            user::where('id', $id)
                ->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
            ]);
        }else{
            user::where('id', $id)
                ->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'rule' =>$request->chucvu,
            ]);
        }
        return redirect()->back()->with('message', 'Chỉnh sửa thông tin thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->rule > 2) {
            # code...
            return redirect()->back();
        }
        DB::table('users')->where('id',$id)->delete();
        return redirect()->back()->with('message', 'Xóa thành viên thành công.');
    }
    public function thayavatarmember(Request $rq)
    {
        $id = $rq->id;
        if ($rq->hasFile('myfile')) {
            $file = $rq->file('myfile');
            $link = DB::table('users')->select('avatar')->where('id',$id)->get();
            foreach ($link as $key) {
                $a = $key->avatar;
            }
            if ($a != 'logo.png') {
                File::delete('public/avatar/'.$a);
            }
            $fileName = $file -> getClientOriginalName('myfile');
            $fileName = str_slug($fileName, '-');
            $fileName = $fileName.'.'.$file -> getClientOriginalExtension('myfile');
            $t=time();
            $a =  $t.'_'.$fileName;
            $file->move('public/avatar',$a);
            $doiten = 'public/avatar/'.$a;
            $img = Image::make($doiten)->resize(300, 300)->save($doiten);
            user::where('id', $id)
                ->update([
                'avatar' => $a,
            ]);

            return redirect()->back()->with('message', 'Chỉnh sửa avatar thành công.');
        }else{
            return redirect()->back();
        }
    }
    public function suathongtinmember(Request $rq)
    {
        user::where('id', $rq->id)
            ->update([
            'name' => $rq->hoten,
            'phone' => $rq->sdt,
        ]);
        return redirect()->back()->with('message', 'Chỉnh sửa thông tin thành công.');
    }
    public function editpass(Request $rq)
    {
        $mk1 = $rq['password1'];
        $mk2 = $rq['password2'];
        if($mk1 != $mk2){
            return redirect()->back()->with('message2', 'Đổi mật khẩu không thành công.');
        }elseif($mk1 == ''){
            return redirect()->back()->with('message2', 'Đổi mật khẩu không thành công.');
        }
        user::where('id', $rq->id)
            ->update([
            'password' => bcrypt($mk1)
        ]);
        return redirect()->back()->with('message', 'Đổi mật khẩu thành công.');
    }
    public function timkiemthanhvienadmin(Request $rq)
    {
        $search = addslashes($rq->value);
        if ($search != '') {
            $userqt = DB::table('users')->where('name','like',"%$search%")->where('rule','<=','5')->get();
            $doanhnghiep = DB::table('users')->where('name','like',"%$search%")->where('rule','=','6')->get();
            $gatekeeper = DB::table('users')->where('name','like',"%$search%")->where('rule','=','7')->get();
            $sinhvien = DB::table('users')->where('name','like',"%$search%")->where('rule','=','8')->get();
        }else{
            return redirect()->back();
        }
        return view('admin.member',['userqt'=>$userqt,'doanhnghiep'=>$doanhnghiep,'gatekeeper'=>$gatekeeper,'sinhvien'=>$sinhvien,'menu'=>'member']);
    }
}

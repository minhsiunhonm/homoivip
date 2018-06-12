<?php

namespace App\Http\Controllers;

use Input,File;
use Illuminate\Http\Request;
use App\Http\Requests\thongtincanhan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Image;
use App\User;
use App\very;
use Hash;

class VeryController extends Controller
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
        if (Auth::check() && Auth::user()->rule != 1) {
            return redirect()->back();
        }
        $very = \App\very::with('users')->where('status',0)->paginate(1);
        return view('admin.very',['menu'=>'very','very'=>$very]);
    }
    public function loadmem(Request $rq)
    {
        $very = DB::table('very')->where('id',$rq->veryid)->get();
        foreach ($very as $key) {
            $id_user = $key->id_user;
        }
        $user = DB::table('users')->where('id',$id_user)->get();
        return view('ajax.getmemverry',['very'=>$very,'user'=>$user]);
    }
    public function nomem($id)
    {
        if (Auth::user()->rule != 1) {
            return redirect()->back()->with('error','Có lỗi sảy ra!');
        }
        DB::table('very')->where('id',$id)->delete();
        return redirect()->back()->with('suc','Hủy thành công!');
    }
    public function yesmem($id)
    {
        if (Auth::user()->rule != 1) {
            return redirect()->back()->with('error','Có lỗi sảy ra!');
        }
        very::where('id',$id)
            ->update([
            'status' => '1'
        ]);
        $very = DB::table('very')->where('id',$id)->select('id_user')->get();
        foreach ($very as $key) {
            $id_user = $key->id_user;
        }
        user::where('id',$id_user)
            ->update([
            'very' => '1'
        ]);
        return redirect()->back()->with('suc','Phê duyệt thành công!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

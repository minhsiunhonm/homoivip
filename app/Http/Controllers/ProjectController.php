<?php

namespace App\Http\Controllers;

use App\User;
use App\modul;
use App\team;
use App\rule;
use App\question;
use App\project;
use Input,File;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idselect = 'yeucaupheduyet';
        $project = \App\project::where('ngaybatdau','0000-01-01')->where('hidden','0')->paginate(12);
        $status = DB::table('status')->paginate(12);
        $driengtu = DB::table('project')->where('hidden','0')->where('status',1)->count();
        $dcongkhai = DB::table('project')->where('hidden','0')->where('status',2)->count();
        $ddth = DB::table('project')->where('hidden','0')->where('status',3)->count();
        $dhoanthanh = DB::table('project')->where('hidden','0')->where('status',4)->count();
        $dthungrac = DB::table('project')->where('hidden','1')->count();
        $dyeucaupheduyet = DB::table('project')->where('ngaybatdau','0000-01-01')->count();
        return view('admin/project',['project'=>$project,'menu'=>'project','status'=>$status,'idselect'=>$idselect,'driengtu'=>$driengtu,'dcongkhai'=>$dcongkhai,'ddth'=>$ddth,'dhoanthanh'=>$dhoanthanh,'dthungrac'=>$dthungrac,'dyeucaupheduyet'=>$dyeucaupheduyet]);
    }
    public function __construct()
    {
        $this->middleware('auth');
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
        $idselect = $id;
        if ($idselect == 'thungrac') {
            $project = \App\project::where('hidden','1')->paginate(12);
        }
        if ($idselect == 'yeucaupheduyet') {
            $project = \App\project::where('ngaybatdau','0000-01-01')->where('hidden','0')->paginate(12);
        }else{
            $project = \App\project::where('hidden','0')->where('status',$idselect)->paginate(12);
        }
        $status = DB::table('status')->get();
        $driengtu = DB::table('project')->where('hidden','0')->where('status',1)->count();
        $dcongkhai = DB::table('project')->where('hidden','0')->where('status',2)->count();
        $ddth = DB::table('project')->where('hidden','0')->where('status',3)->count();
        $dhoanthanh = DB::table('project')->where('hidden','0')->where('status',4)->count();
        $dyeucaupheduyet = DB::table('project')->where('ngaybatdau','0000-01-01')->count();
        $dthungrac = DB::table('project')->where('hidden','1')->count();
        return view('admin/project',['project'=>$project,'menu'=>'project','status'=>$status,'idselect'=>$idselect,'driengtu'=>$driengtu,'dcongkhai'=>$dcongkhai,'ddth'=>$ddth,'dhoanthanh'=>$dhoanthanh,'dthungrac'=>$dthungrac,'dyeucaupheduyet'=>$dyeucaupheduyet]);
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
    public function thungrac($id)
    {
        if(Auth::check() && Auth::user()->rule == '1'){
            project::where('id',$id)
                ->update([
                'hidden' => '1'
            ]);
        }
        return redirect()->back();
    }
    public function khoiphucthungrac($id)
    {
        if(Auth::check() && Auth::user()->rule == '1'){
            project::where('id',$id)
                ->update([
                'hidden' => '0',
            ]);
        }
        return redirect()->back();
    }
}

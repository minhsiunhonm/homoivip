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

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.bill',['menu'=>'bill']);
    }
    public function timkiembill(Request $rq)
    {
        $search = addslashes($rq->data);
        if ($search != '') {
            // $invest = DB::table('invest')->where('id','like',"%$search%")->get();
            $invest = DB::table('invest')->where('id',"%$search%")->get();
            return '$invest';
            return view('duan.loadajax.sinhvien',['users'=>$users,'position'=>$position]);
        }else{
            return '';
        }
    }
}

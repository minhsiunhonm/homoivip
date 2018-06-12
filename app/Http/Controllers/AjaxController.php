<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller {
	public function get_home(Request $request){
	    if($request->ajax() || 'NULL'){
		    return '123123132';
	    }
	}
}

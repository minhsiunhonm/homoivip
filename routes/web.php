<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('send_email', 'EmailController@sendEmailReminder')->name('send_email'); //index

Route::group(['middleware' => 'auth','middleware' => 'admin','prefix' => 'm'], function () { 

	Route::get('', 'HomeController@index')->name('dashboard'); //index

	Route::resource('mail', 'MailController'); //very
	Route::resource('very', 'VeryController'); //very
	Route::resource('project', 'ProjectController',['only'=>['index','create','show','edit']]); //project
	Route::resource('member', 'MemberController')->names(['index' => 'member.index']);; //project
	Route::post('timkiemthanhvienadmin',['as'=>'timkiemthanhvienadmin','uses'=>'MemberController@timkiemthanhvienadmin']);
	Route::resource('bill', 'BillController')->names(['index' => 'bill.index']);; //project
	Route::get('timkiembill', 'BillController@timkiembill')->name('timkiembill'); 
	Route::get('thungrac/{id}', 'ProjectController@thungrac')->name('thungrac'); 
	Route::get('khoiphucthungrac/{id}', 'ProjectController@khoiphucthungrac')->name('khoiphucthungrac'); 
	Route::post('suathongtinmember',['as'=>'suathongtinmember','uses'=>'MemberController@suathongtinmember']);
	Route::post('editpass',['as'=>'editpass','uses'=>'MemberController@editpass']);
	Route::get('loadmem', 'VeryController@loadmem')->name('loadmem');  // thong bao ajax
	Route::get('yesmem/{id}', 'VeryController@yesmem')->name('yesmem');  // thong bao ajax
	Route::get('nomem/{id}', 'VeryController@nomem')->name('nomem');  // thong bao ajax
});
Route::post('thayavatarmember',['as'=>'thayavatarmember','uses'=>'MemberController@thayavatarmember']);
Route::get('', 'WebController@index')->name('index');
Route::get('chitiet', 'WebController@chitiet')->name('chitiet');
Route::get('/login', 'LoginController@login')->name('login');
Route::get('register', 'LoginController@register')->name('register');
Route::post('plogin',['as'=>'plogin','uses'=>'LoginController@plogin']);
Route::post('posregister',['as'=>'posregister','uses'=>'LoginController@posregister']);
Route::get('/logout', function(){  // đăng suất
	Auth::logout(); 
	return redirect()->route('login'); 
})->name('logout');



//dang ky
Route::get('tao-du-an', 'DuanController@viewtaoduan')->name('viewtaoduan');
Route::get('dongythamgia/{id}', 'DuanController@dongythamgia')->name('dongythamgia');
Route::get('tuchoithamgia/{id}', 'DuanController@tuchoithamgia')->name('tuchoithamgia');
Route::get('thamgiaduan/{id}', 'DuanController@thamgiaduan')->name('thamgiaduan');
Route::post('taoduan',['as'=>'taoduan','uses'=>'DuanController@taoduan']);
Route::get('duan', 'DuanController@duan')->name('duan');
Route::get('project/{id}', 'WebController@project')->name('project');
Route::get('suathongtincoban/{id}', 'DuanController@suathongtincoban')->name('suathongtincoban');
Route::get('suanoidung/{id}', 'DuanController@suanoidung')->name('suanoidung');
Route::post('suattcoban',['as'=>'suattcoban','uses'=>'DuanController@suattcoban']);
Route::post('themmodul',['as'=>'themmodul','uses'=>'DuanController@themmodul']);
Route::get('lenmodul/{id}', 'DuanController@lenmodul')->name('lenmodul');
Route::get('xuongmodul/{id}', 'DuanController@xuongmodul')->name('xuongmodul');
Route::get('suamodul/{id}', 'DuanController@suamodul')->name('suamodul');
Route::get('xoamodul/{id}', 'DuanController@xoamodul')->name('xoamodul');
Route::post('suamoduls',['as'=>'suamoduls','uses'=>'DuanController@suamoduls']);
Route::get('hinhanh/{id}', 'DuanController@hinhanh')->name('hinhanh');
Route::post('thayavatar',['as'=>'thayavatar','uses'=>'DuanController@thayavatar']);
Route::post('thaybanner',['as'=>'thaybanner','uses'=>'DuanController@thaybanner']);

Route::get('thanhvien/{id}', 'DuanController@thanhvien')->name('thanhvien');
Route::get('yeucauthamgia/{id}', 'DuanController@yeucauthamgia')->name('yeucauthamgia');
Route::get('thanhvienyeucau/{id}', 'DuanController@thanhvienyeucau')->name('thanhvienyeucau');
Route::get('pheduyettvyc/{id}', 'DuanController@pheduyettvyc')->name('pheduyettvyc');
Route::get('tuchoitvyc/{id}', 'DuanController@tuchoitvyc')->name('tuchoitvyc');
Route::get('dautu/{id}', 'DuanController@dautu')->name('dautu');
Route::get('taodautu', 'DuanController@taodautu');
Route::get('guiyeucaupheduyet/{id}', 'DuanController@guiyeucaupheduyet')->name('guiyeucaupheduyet');
Route::get('tiendoduandera/{id}', 'DuanController@tiendoduandera')->name('tiendoduandera');
Route::get('bangdutoan/{id}', 'DuanController@bangdutoan')->name('bangdutoan');
Route::get('suathongtincobanduan/{id}', 'DuanController@suathongtincobanduan')->name('suathongtincobanduan');
Route::get('modulgioithieu/{id}', 'DuanController@modulgioithieu')->name('modulgioithieu');

Route::post('danhgiagate',['as'=>'danhgiagate','uses'=>'DuanController@danhgiagate']);
Route::post('danhgiandt',['as'=>'danhgiandt','uses'=>'DuanController@danhgiandt']);
Route::post('danhgiasv',['as'=>'danhgiasv','uses'=>'DuanController@danhgiasv']);
Route::get('xoatiendoduan',['as'=>'xoatiendoduan','uses'=>'DuanController@xoatiendoduan']);
Route::post('formdutoan',['as'=>'formdutoan','uses'=>'DuanController@formdutoan']);
Route::post('suamoney',['as'=>'suamoney','uses'=>'DuanController@suamoney']);
Route::post('pheduyetduan',['as'=>'pheduyetduan','uses'=>'DuanController@pheduyetduan']);
Route::post('riengtuduan',['as'=>'riengtuduan','uses'=>'DuanController@riengtuduan']);
Route::post('timkiemduanadmin',['as'=>'timkiemduanadmin','uses'=>'DuanController@timkiemduanadmin']);
Route::post('themcauhoi',['as'=>'themcauhoi','uses'=>'DuanController@themcauhoi']);
Route::post('thayvideo',['as'=>'thayvideo','uses'=>'DuanController@thayvideo']);
Route::post('thayvideo',['as'=>'thayvideo','uses'=>'DuanController@thayvideo']);

Route::get('getRequest', 'NoteController@getRequest'); // ajax tim kiem sinh vien
Route::get('getRequestgate', 'NoteController@getRequestgate'); // ajax tim kiem sinh vien
Route::get('moithanhvien', 'NoteController@moithanhvien'); // ajax moi thanh vien vao du an
Route::get('huymoi', 'DuanController@huymoi')->name('huymoi'); 
Route::get('huymoigt', 'DuanController@huymoigt')->name('huymoigt'); 
Route::get('moigate', 'NoteController@moigate'); 

Route::get('loadajaxalert', 'NoteController@loadajaxalert')->name('loadajaxalert');  // thong bao ajax
Route::get('loadajaxalerttiep', 'NoteController@loadajaxalerttiep')->name('loadajaxalerttiep');  // thong bao ajax
Route::get('moddautu', 'DuanController@moddautu')->name('moddautu');  // thong bao ajax

Route::get('xoadutoan/{id}', 'DuanController@xoadutoan')->name('xoadutoan');  //ajax getidhoadon

Route::post('suadutoan',['as'=>'suadutoan','uses'=>'DuanController@suadutoan']);
Route::post('xoacauhois',['as'=>'xoacauhois','uses'=>'DuanController@xoacauhois']);
Route::get('xoacauhoi', 'DuanController@xoacauhoi')->name('xoacauhoi'); 
Route::get('xoaduan/{id}', 'DuanController@xoaduan')->name('xoaduan'); 
Route::get('caidat/{id}', 'DuanController@caidat')->name('caidat'); 
Route::post('themtiendo',['as'=>'themtiendo','uses'=>'DuanController@themtiendo']);
Route::post('suatiendo',['as'=>'suatiendo','uses'=>'DuanController@suatiendo']);



Route::post('suathongtincanhan',['as'=>'suathongtincanhan','uses'=>'CanhanController@suathongtincanhan']);
Route::post('doimatkhaus',['as'=>'doimatkhaus','uses'=>'CanhanController@doimatkhaus']);
Route::post('themkynang',['as'=>'themkynang','uses'=>'CanhanController@themkynang']);
Route::post('themtruonghoc',['as'=>'themtruonghoc','uses'=>'CanhanController@themtruonghoc']);
Route::post('themcongviec',['as'=>'themcongviec','uses'=>'CanhanController@themcongviec']);
Route::post('xoakynang',['as'=>'xoakynang','uses'=>'CanhanController@xoakynang']);
Route::post('xoatruonghoc',['as'=>'xoatruonghoc','uses'=>'CanhanController@xoatruonghoc']);
Route::post('xoacongviec',['as'=>'xoacongviec','uses'=>'CanhanController@xoacongviec']);

// landing page
Route::get('gioithieu', 'LandingController@gioithieu')->name('gioithieu'); 
Route::post('verymem',['as'=>'verymem','uses'=>'LandingController@verymem']); 

// landing page
Route::get('verymailax', 'CanhanController@verymailax')->name('verymailax');  // very ajax
Route::get('register/verify/{code}', 'CanhanController@verify');

// NEW teamplate
Route::get('step1/{id}', 'EditproController@step1')->name('step1');
Route::get('step1bar/{id}', 'EditproController@step1bar')->name('step1bar');
Route::get('step2bar/{id}', 'EditproController@step2bar')->name('step2bar');
Route::get('step3bar/{id}', 'EditproController@step3bar')->name('step3bar');
Route::get('step2/{id}', 'EditproController@step2')->name('step2');
Route::get('step3/{id}', 'EditproController@step3')->name('step3');
Route::get('editpro/{id}', 'EditproController@editpro')->name('editpro');
Route::get('checkslide/{id}', 'EditproController@checkslide')->name('checkslide');
Route::get('checkvideo/{id}', 'EditproController@checkvideo')->name('checkvideo');
Route::get('step1sub', 'EditproController@step1sub')->name('step1sub');
Route::get('step2sub', 'EditproController@step2sub')->name('step2sub');
Route::get('themkpi', 'EditproController@themkpi')->name('themkpi');
Route::get('delekpi', 'EditproController@delekpi')->name('delekpi');
// NEW teamplate

//end
Route::get('follow', 'CanhanController@follow')->name('follow');  //ajax follow
Route::get('{id}/thong-tin-ca-nhan', 'CanhanController@thongtincanhan')->name('thongtincanhan');
Route::get('{id}/doi-mat-khau', 'CanhanController@doimatkhau')->name('doimatkhau');
Route::get('{id}', 'CanhanController@canhan')->name('canhan');
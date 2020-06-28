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

use App\Http\Controllers\DashController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/login','AdminController@login');
Route::get('/logout','AdminController@logout');
Route::post('/create','AdminController@Create');



Route::get('/dashboard','DashController@dashboard');
Route::post('/save_url','DashController@save_url');

Route::post('/import','DashController@importfile');
Route::get('/delete_xml/{id}','DashController@delete_xml');


Route::get('/realchart','ChartController@realchart');
Route::get('/charts','ChartController@index');

Route::get('/charttem',function(){
	return view('admin.chartch')->with('findval','TEMP')
	->with('title','Temperature');
});
Route::get('/chartch',function(){
	return view('admin.chartch')->with('findval','CL')
	->with('title','Chlorine');
});
Route::get('/chartph',function(){
	return view('admin.chartch')->with('findval','PH')
	->with('title','PH');
});

Route::get('/chartorp',function(){
	return view('admin.chartch')->with('findval','ORP')
	->with('title','ORP');
});

Route::get('/chartch_t',function(){
	return view('admin.chartch')->with('findval','TOTAL_CL')
	->with('title','Chlorine Total');
});

Route::get('/chartch_c',function(){
	return view('admin.chartch')->with('findval','COMB_CL')
	->with('title','Chlorine Comb');
});




Route::get('/add_user', 'UserController@index');
Route::post('/save_user','UserController@save_user');
Route::post('/update_user','UserController@update_user');
Route::get('/update_allow_email/{id}/{checkStatus}','UserController@update_allow_email');
Route::get('/usertable','UserController@show');
Route::get('/update_userinfo/{id}','UserController@update_userinfo');
Route::post('/save_emailinfo','UserController@save_emailinfo');
Route::get('/delete_userinfo/{id}','UserController@delete_userinfo');

Route::get('/unactive_label/{id}', 'UserController@unactive');
Route::get('/active_label/{id}', 'UserController@active');
Route::get('/delete/{id}','UserController@delete');



####common
// Route::get('/common', 'DashController@common' );
Route::get('/common', 'DashController@commonitems' );
Route::get('/main_pool/{id}','DashController@main_pool');

Route::get('/find_pool/{id}','DashController@find_pool');
Route::get('/common_charts','ChartController@common_charts');
Route::get('/common_charttem',function(){
	return view('common.chartch')->with('findval','TEMP')->with('title','Temperature Detail');
});
Route::get('/common_chartch',function(){
	return view('common.chartch')->with('findval','CL')
	->with('title','Chlorine ');
});
Route::get('/common_chartph',function(){
	return view('common.chartch')->with('findval','PH')
	->with('title','PH ');
});

Route::get('/common_chartorp',function(){
	return view('common.chartch')->with('findval','ORP')
	->with('title','ORP ');
});

Route::get('/common_chartch_t',function(){
	return view('common.chartch')->with('findval','TOTAL_CL')
	->with('title','Chlorine Total');
});

Route::get('/common_chartch_c',function(){
	return view('common.chartch')->with('findval','COMB_CL')
	->with('title','Chlorine Comb');
});
Route::get('/history','DashController@histroy');
Route::get('/service','DashController@service');
Route::post('/main_saveval','DashController@main_saveval');
Route::post('/saveval', 'DashController@saveval');
Route::post('/mainemail_check','DashController@mainemail_check');
Route::post('/email_check','DashController@email_check');
// Route::get('/unactive_email/{id}', 'DashController@unactive');
// Route::get('/active_email/{id}', 'DashController@active');

Route::post('/emailsend','DashController@emailsend');

Route::post('/save_emails','DashController@save_emails');
Route::get('/delete_emails/{id}','DashController@delete_emails');







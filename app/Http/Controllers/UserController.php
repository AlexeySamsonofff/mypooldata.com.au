<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use Auth;

class UserController extends Controller
{
    function index()
    {
     return view('admin.add_user');
    }
   
    public function show()
    {
    	$all_user =DB::table('users')->get();
    	return view('admin.usertable')->with('all_user',$all_user);
    }
     public function unactive($id){
        DB::table('users')->where('id', $id)
            ->update(['allow' => 0]);
        return redirect('/usertable');
    }

    public function active($id){
        DB::table('users')->where('id', $id)
            ->update(['allow' => 1]);
        return redirect('/usertable');
    }
    public function delete($id){
        DB::table('users')->where('id', $id)
            ->delete();
        return redirect('/usertable');
    }
   
    public function save_user(){
        $username =Input::post('username');
        $useremail =Input::post('useremail');
        $password =Input::post('password');
        $repassword =Input::post('repassword');
        $machine_id =Input::post('machine_id');
        $pool_name =Input::post('pool_name');
        $yourTimezone =Input::post('yourTimezone');
        if($password ==$repassword){
            DB::table('users')->insertGetId(
                ['name'=>$username,'email'=>$useremail,'password'=>md5($password) , 'machine_id'=>$machine_id,'pool_name'=>$pool_name, 'yourtimezone'=>$yourTimezone]);
            return back()->with('success','Add memberuser successfully!');

        }
        else{
            return back()->with('error','password and confirm password wrong!');
        }
    }
    public function update_user()
    {
        $userid =Input::post('userid');
        $data['name']=Input::post('username');
        $data['machine_id']=Input::post('machine_id');
        $data['pool_name']=Input::post('pool_name');
        $data['yourtimezone'] =Input::post('yourTimezone');
        DB::table('users') ->where('id', $userid)
            ->update($data);
        return redirect('/usertable');
    }

    public function update_allow_email($id, $checkStatus)
    {
        $data['allow_email'] =$checkStatus;
        DB::table('users') ->where('id', $id)->update($data);

        return "success";
    }

    public function update_userinfo($id)
    {
        $user_info =DB::table('users')->where('id',$id)->first();
         return view('admin.add_email')->with('user_info',$user_info);
    }

    public function save_emailinfo()
    {
        $user_id =Input::post('hidden_id');
        $machine_id =Input::post('machine_id');
        $pool_name =Input::post('pool_name');
        $yourTimezone =Input::post('yourTimezone');
        DB::table('tbl_user')->insertGetId(['user_id'=>$user_id,'machine_id'=>$machine_id,'pool_name'=>$pool_name, 'yourtimezone'=>$yourTimezone]);
        return back()->with('success','add user infomation successfully!');
    }
    public function delete_userinfo($id)
    {
        DB::table('tbl_user')->where('tbl_id',$id)
        ->delete();
        return back()->with('success','delete success');
    }
}

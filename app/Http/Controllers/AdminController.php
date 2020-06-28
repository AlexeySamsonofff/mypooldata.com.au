<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Redirect,Response;
use Session;
use Mail;
use Validator;
use Auth;


class AdminController extends Controller
{
    function index()
    {
     return view('login');
    }
    function login(Request $request)
    {
         $email =Input::post('email');
         $password =Input::post('password');
         $user =DB::table('users')->where('email', $email)->first();
         if($user ==NULL)
         {
            return back()->with('error', 'Wrong Login Details');
         }
         else
         {
            if($user->password ==md5($password))
            {
                if($user->allow ==1){
                    if($user->userlevel ==1){
                        Session::put('user_id',$user->id);
                         Session::put('email',$user->email);
                        Session::put('name',$user->name);
                        Session::put('machine_id',$user->machine_id);
                        Session::put('pool_name',$user->pool_name);
                        return redirect('/dashboard');
                    }
                    else{
                        Session::put('user_id',$user->id);
                         Session::put('email',$user->email);
                        Session::put('name',$user->name);
                        Session::put('machine_id', $user->machine_id);
                        Session::put('pool_name',$user->pool_name);
                        return redirect('/common');

                    }
                   
                }
                else{
                    return back()->with('wait','plase wait  until confirm');
                }
            }
            else{
                return back()->with('error', 'Wrong Password');
            }
         }
    }

   

    function logout()
    {
     Auth::logout();
     return redirect('/');
    }
    function Create(){
        $username =Input::post('username');
        $useremail =Input::post('useremail');
        $password =Input::post('password');
        $repassword =Input::post('repassword');
        if($password ==$repassword){
            DB::table('users')->insertGetId(
                ['name'=>$username,'email'=>$useremail,'password'=>md5($password)]);
            return redirect('/');

        }
        else{
            return '<script> alert("new password and confirm password is not incorredt"); </script>';
        }
    }
}

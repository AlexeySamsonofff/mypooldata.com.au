<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;
use Auth;
use DB;
use Redirect;
use DateTime;
use File;
use App\Mail\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class DashController extends Controller
{
    // public function __construct()
    // {
    //   return redirect('/');
    // }

    function index()
    {
     return view('admin.charts');
    }
    function dashboard()
    {
      
      return view('admin.dashboard');

    }
    public function main_pool($id)
    {
     
      $data = array();
      $e_id ='11'.$id;
      $pool_info =DB::table('users')->select('users.*')->where('id',$id)->get();
      $email_info =DB::table('tbl_email')->select('tbl_email.*')->where('pool_id',$e_id)->get();
      // print_r($email_info);exit;
      $data['pool_info'] = $pool_info;
      $data['email_info'] = $email_info;
      die(json_encode($data));
      // return view('common.dashboard')->with('all_info',$all_info);
    }
    public function find_pool($id)
    {
      $data = array();
      $pool_info =DB::table('tbl_user')->select('tbl_user.*')->where('tbl_id',$id)->get();
      $email_info =DB::table('tbl_email')->select('tbl_email.*')->where('pool_id',$id)->get();
      // print_r($email_info);exit;
      $data['pool_info'] = $pool_info;
      $data['email_info'] = $email_info;
      die(json_encode($data));
      // return view('common.dashboard')->with('all_info',$all_info);
    }
    public function main_saveval(Request $request)
    {
      $item_name =$request->val_name;
      $data['id'] =$request->tbl_id;
      $data[$item_name] =$request->val;
      
      // $data['item_id'] =$request->val_id;
      DB::table('users')->where('id',$data['id'])->update($data);

      return ($data);
    }
    public  function mainemail_check(Request $request)
    {
      $data['id'] =$request->id;
      $data['ch_name'] =$request->ch_name;
      $data['val'] =$request->val;
      DB::table('users')->where('id',$data['id'])->update([$data['ch_name'] => $data['val']]);
      print_r(json_encode($data));
      
      
    }

   

    public function saveval(Request $request)
    {      
      $item_name =$request->val_name;
      $data['tbl_id'] =$request->tbl_id;
      $data[$item_name] =$request->val;
      
      // $data['item_id'] =$request->val_id;
      DB::table('tbl_user')->where('tbl_id',$data['tbl_id'])->update($data);

      return ($data);
      // var_dump($data['ph_h']);
      // return view('common.dashboard')->with('data', $data);
    
    }

    public  function email_check(Request $request)
    {
      $data['tbl_id'] =$request->tbl_id;
      $data['ch_name'] =$request->ch_name;
      $data['val'] =$request->val;
      DB::table('tbl_user')->where('tbl_id',$data['tbl_id'])->update([$data['ch_name'] => $data['val']]);
      print_r(json_encode($data));
      
      
    }
   
    public function emailsend(Request $request)
    {
      $id =$request->pool_id;
      $alarmContent = $request->alarmContent;
      $alarmSubject = $request->alarmSubject;

      $emails =DB::table('tbl_email')->where('pool_id',$id)->get();
      foreach($emails as $v_email) {
        $sendemail =$v_email->email_addr;
        $to = $sendemail;
        $headers = "From: alarms@mypooldata.com.au" . "\r\n" .
        "CC: alarms@mypooldata.com.au";

        // mail($to,$alarmSubject,$alarmContent,$headers);
        // $data = array('email' => $to, 'subject' => $alarmSubject);
        $data['subject'] = $alarmSubject;
        $data['content'] = $alarmContent;
        $data['email'] = $to;
        Mail::send('email.sendmail', $data, function ($message) use ($data) {
          $message->from('alarms@mypooldata.com.au', 'Alert');
          $message->to($data['email']);
          $message->subject($data['subject']); 
        });
        // $name = 'Krunal';
        
        // Mail::to($to)->send(new SendMail($data));
        
        return 'Email was sent';
      }    
    }

    public function commonitems(Request $request)
    {      
      $id =2;
      // $all_info =DB::table('users')->select('users.*')->where('id',id)->get();
      return view('common.dashboard');
    }

    public function save_emails(Request $request)
    {
      $pool_id =Input::post('hidden_id');
      $email =Input::post('email');
    
      DB::table('tbl_email')->insert(['pool_id'=>$pool_id,'email_addr'=>$email]);
      return redirect('/common');
    }
    
    public function delete_emails($id)
    {
      DB::table('tbl_email')->where('tbl_id',$id)->delete();
      return redirect('/common');
    }
    public function histroy()
    {
      return view('common.history');
    }
    public function service()
    {
      return view('common.service');
    }


    
}

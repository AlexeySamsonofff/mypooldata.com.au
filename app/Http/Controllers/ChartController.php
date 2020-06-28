<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Validator;
use Auth;
use DB;

class ChartController extends Controller
{
    function index()
    {
     return view('admin.charts');
    }
  

    public function realchart()
    {
        return view('admin.realchart');
    }
    
   

    
}

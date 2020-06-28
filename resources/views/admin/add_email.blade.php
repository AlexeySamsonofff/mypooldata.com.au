@extends('admin_layout')
@section('admin_content')
          
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Pool and Machine_id to machine user </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Pool</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="callout callout-danger">
        <p><label>email: </label> {{$user_info->email}}</p>
        <p><label>machine_id: </label> {{$user_info->machine_id}}</p>
        <p> <label>pool_name: </label> {{$user_info->pool_name}}</p>  
        <p> <label>timezone: </label> 
          @if($user_info->yourtimezone == 10) QLD (UTC + 10)
          @elseif($user_info->yourtimezone == 11) NSW, ACT, VIC, TAS (UTC + 11)
          @elseif($user_info->yourtimezone == 9.5) NT (UTC + 9:30)
          @elseif($user_info->yourtimezone == 10.5) SA (UTC + 10:30)
          @elseif($user_info->yourtimezone == 8) WA (UTC + 8)
          @else 
          @endif
        </p>       
       
    </div>
    <?php $musers_info =DB::table('tbl_user')->where('user_id',$user_info->id)->get();  ?>
    @foreach($musers_info as $muser)
    <div class="callout callout-info">
        <p><label>machine_id: </label> {{$muser->machine_id}}</p>
        <p> <label>pool_name: </label> {{$muser->pool_name}}</p> 
        <p> <label>timezone: </label>
          @if($muser->yourtimezone == 10) QLD (UTC + 10)
          @elseif($muser->yourtimezone == 11) NSW, ACT, VIC, TAS (UTC + 11)
          @elseif($muser->yourtimezone == 9.5) NT (UTC + 9:30)
          @elseif($muser->yourtimezone == 10.5) SA (UTC + 10:30)
          @elseif($muser->yourtimezone == 8) WA (UTC + 8)
          @else 
          @endif
        </p>   
        <a class="btn btn-danger" href="{{url('/delete_userinfo/'.$muser->tbl_id)}}"><i class="fas fa-trash"></i></a>      
       
    </div>
   @endforeach          


<div class="col-12  col-lg-12">
    <div class="card-header">
         @if ($message = Session::get('error'))
         <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
         </div>
         @endif
          @if ($message = Session::get('success'))
         <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
         </div>
         @endif
    </div>          
    <div class="card-body">
      <div class="col-lg-10">
          <form class="form-horizontal" action="{{url('/save_emailinfo')}}" method="post" enctype="multipart/form-data">
              @csrf
              <fieldset>
                  <input type="hidden" name="hidden_id" value="{{$user_info->id}}">
                  
                  
                  <div class="form-group row">
                       <label  class="col-sm-2 col-form-label" >Pool name</label>
                       <div class="col-sm-10">
                          <input type="text" class="form-control" id="useremail" name="pool_name">
                        </div>
                  </div>
                  <div class="form-group row">
                       <label  class="col-sm-2 col-form-label" >Machine_id</label>
                       <div class="col-sm-10">
                          <input type="text" class="form-control" id="useremail" name="machine_id">
                        </div>
                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-2 col-form-label" >Timezone</label>
                    <div class="col-sm-10">
                      <select class="browser-default custom-select" name="yourTimezone">
                        <option selected value="">Select your timezone</option>
                        <option value="10">QLD (UTC + 10)</option>
                        <option value="11">NSW, ACT, VIC, TAS (UTC + 11)</option>
                        <option value="9.5">NT (UTC + 9:30)</option>
                        <option value="10.5">SA (UTC + 10:30)</option>
                        <option value="8">WA (UTC + 8)</option>
                      </select>
                    </div>
                </div>
              </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="savebtn" >Save</button>
              </fieldset>
          </form>
      </div>
    </div>
 </div>


    




@endsection

@extends('admin_layout')
@section('admin_content')
          
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add MemberUser</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add MemberUser</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
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
            <form class="form-horizontal" action="{{url('/save_user')}}" method="post" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" name="useremail" class="form-control" id="useremail" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="repassword" class="form-control" id="repassword" placeholder="Confirm">
                      </div>
                    </div>
                    <div class="form-group row">
                         <label  class="col-sm-2 col-form-label" >Pool name</label>
                         <div class="col-sm-10">
                            <input type="text" class="form-control" id="pool_name" name="pool_name">
                          </div>
                    </div>
                    <div class="form-group row">
                         <label  class="col-sm-2 col-form-label" >Machine id</label>
                         <div class="col-sm-10">
                            <input type="text" class="form-control" id="machine_id" name="machine_id">
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

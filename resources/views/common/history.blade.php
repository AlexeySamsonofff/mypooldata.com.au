@extends('common_layout')
@section('common_content') 

<div>
<img class="content-img" src="/public/img/w2.gif">
</div> 
<div>
<p id="pool_div" ></p>
<input type="hidden" id="startdate">
<input type="hidden" id="enddate">
</div>

<section class="content-header">
  
  <div class="container-fluid">
    <div class="row mb-2">
      <!-- <div class="col-sm-6">
        <h1></h1>
      </div> -->
      <div class="col">
        <div class="card card-primary mx-auto" style="max-width: 350px;">
            
          <div class="card-body">
            <?php
              $email = Session::get('email');
              $id = DB::table('users')->select('id')->where('email', $email)->first()->id;
              $main_info =DB::table('users')->select('machine_id')->where('id',$id)->first();

              $user_info = DB::table('tbl_user')->where('user_id', $id)->get();
              ?>
                          
            <div class="form-group">
              <label>select site</label>
              <select class="form-control select2bs4" id="site_select"  style="width: 100%;">
                <option selected="selected" title="{{$main_info->machine_id}}">{{Session::get('pool_name')}}</option>
                @foreach($user_info as $user_i)                             
                <option pool_id="{{ $user_i->tbl_id}}"  title="{{$user_i->machine_id}}">{{$user_i->pool_name }}</option>
                @endforeach
                
              </select>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
              <label>select options</label>
              <select class="form-control select2bs4" id="option_select" style="width: 100%;">
                <option >select options</option>
                <option title="PH">PH</option>
                <option title="ORP">ORP</option>
                <option title="TEMP">Temerature</option>
                <option title="CL">Chlorine</option>
                <option title="TOTAL_CL">Chlorine total</option>
                <option title="COMB_CL">Chlorine combined</option>
              </select>
            </div>
            <!-- /.form-group -->
            <!-- Date range -->
            <div class="form-group">
              <label>Date Selected</label>
              
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right" id="reservation">
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->           

          </div>
          <!-- /.card-body -->
        </div>        
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>



<section class="content">
  <div class="container-fluid">
    <div class="col-md-12">
    
      <!-- /.card -->
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title"></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>                 
          </div>
        </div>
        <div class="card-body">
          <div class="chart" id="chart1">
            <!-- <canvas id="areaChart1" style="min-height: 550px; height: 550px; max-height: 550px; max-width: 100%;"></canvas> -->
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div> 
    <div class="col-md-12">
      
      <!-- /.card -->
      <!-- <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title"></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>                 
          </div>
        </div>
        <div class="card-body">
          <div class="chart" id="chart2">
          </div>
        </div>
      </div> -->
      <!-- /.card -->
    </div>    
      
  </div><!-- /.container-fluid -->
</section>


@endsection

@section('common_footer')
<footer class="fancy-footer-area fancy-bg-dark myfooter">
    <div class="footer-content section-padding-80-50">
        <div class="container">
            <div class="row">
                <!-- Footer Widget -->
               
                <div class="col-sm-6">
                    <div class="single-footer-widget">
                        
                    </div>
                </div>
                <!-- Footer Widget -->
                <div class="col-sm-6" style="float: right;">
                    <div class="single-footer-widget">
                        <h6>Contact Us</h6>
                        <p>info@brauerindustries.com
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Copywrite -->
    <div class="footer-copywrite-area myfooterdiv_d">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <div class="copywrite-content h-100 d-flex align-items-center justify-content-between">
                        <!-- Copywrite Text -->
                        <div class="copywrite-text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | Swimming Pool<i class="fa fa-heart-o" aria-hidden="true"></i> 
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@endsection

@section('common_js')
<script src="/public/upload/history.js"></script>

@endsection

@extends('common_layout')
@section('common_content') 

<div>
<img class="content-img" src="/public/img/w2.jpg">
</div> 
<div class="pool_name_div">
<p id="pool_div" findval={{$findval}}></p>
<input type="hidden" id="startdate">
<input type="hidden" id="enddate">
</div>

<section class="content-header">
  
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
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
                  <h3 class="card-title">{{$title}}</h3>

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
           
        </div>    
          
        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
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
<script src="/public/upload/common_chart.js"></script>
@endsection

@extends('common_layout')
@section('common_content')
<div class="">
  <img class="content-img" src="/public/img/w2.gif">
</div>
<input type="hidden" id="tbl_id">
  <div class="pool_name_div">
    <p id="pool_div"></p>
  </div>

<!-- Main content -->
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->

    

    <div class="row">
      @for($i= 0; $i< 6; $i++) <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box">
          <a href="#" class="small-box-footer footdiv" id="title{{$i}}">
            @switch($i)
              @case(0)
              PH
              @break
              @case(1)
              ORP
              @break
              @case(2)
              Temperature
              @break
              @case(3)
              Chlorine
              @break
              @case(4)
              Chlorine_Total
              @break
              @case(5)
              Chlorine_comb
              @break

            @endswitch

          </a>

          <div class="row">
            <div class="col-sm-5">
              <div class="spandiv" id="h{{$i}}_l{{$i}}"></div>
            </div>
            <div class="col-sm-6">
              high set point:
              <div class="row">
                <div class="col-sm-6">

                  <div class="curdiv" id="h{{$i}}"></div>

                </div>
                <div class="col-sm-6">
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li>
                      <span class="btn btn-pm  plusitem"><i class="fas fa-plus"></i></span>
                    </li>
                    <li>
                      <span class="btn btn-pm  minusitem"><i class="fas fa-minus"></i></span>
                    </li>
                  </ul>
                </div>
              </div>
              low set point:
              <div class="row">
                <div class="col-sm-6">
                  <div class="curdiv" id="l{{$i}}"></div>
                </div>
                <div class="col-sm-6">
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li>
                      <span class="btn btn-pm  plusitem"><i class="fas fa-plus"></i></span>
                    </li>
                    <li>
                      <span class="btn btn-pm  minusitem"><i class="fas fa-minus"></i></span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="noti" id="c{{$i}}">
            <span>Receive Notifications</span>
            <label class="container_ck1">
              <input type="checkbox" 
                id="ck_{{$i}}"
                onclick="notiFunc({{$i}})">
              <span class="checkmark1"></span>
            </label>
          </div>



        </div>
      </div>
      @endfor

    </div>
  <!-- /.row -->
  <!-- Main row -->


  <!-- Left col -->
  <section class="content ">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> ORP </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" id="selectError" findval1="PH" findval2="ORP" findval3="TEMP" findval4="CL" findval5="TOTAL_CL" findval6="COMB_CL" title="{{ Session::get('machine_id')}}" xmlval="xmlfiles/xmlfile202001.XML" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>

            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="areaChart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- cl three chart -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Chlorine</h3>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="cl3Chart" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <!-- PH CHART -->
        <div class="col-md-6">
          <div class="card ">
            <div class="card-header">
              <h3 class="card-title">PH</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="phChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- Temperature CHART -->
        <div class="col-md-6">
          <div class="card ">
            <div class="card-header">
              <h3 class="card-title">Temperature </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="temChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div>



  </section>

  </div><!-- /.container-fluid -->
<!-- /.content -->

<!-- Modal -->
<div id="addemail_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">ADD EMAIL TO RECEIVE ALARM</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <!-- form start -->
        <form role="form" action="{{ url('/save_emails')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <input type="hidden" name="hidden_id" id="hidden_id">
            <div class="form-group">
              <label for="exampleInputEmail1">Email </label>

              <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection

@section('common_footer')
<footer class="fancy-footer-area fancy-bg-dark myfooter">
  <div class="footer-content section-padding-80-50">
    <div class="container">
      <div class="row">
        <!-- Footer Widget -->
        <div class="col-sm-4">
          <div class="card-header">
            <span class="float-left add-email-alarm" onclick="add_modal()">
              <i class="fas fa-plus" style="color: green;"></i> ADD EMAIL TO RECEIVE ALARM
            </span>
          </div>
          <!-- /.card-header -->

          <div class="card-body" id="emaildiv">

          </div>

        </div>

        <div class="col-sm-4">
          <div class="single-footer-widget">
            
          </div>
        </div>
        <!-- Footer Widget -->
        <div class="col-sm-4">
          <div class="single-footer-widget pt-3">
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
<script src="/public/plugins/chart.js/Chart.min.js"></script>
<script src="/public/upload/common_dash.js"></script>
<script src="/public/upload/common_chart2.js"></script>

<script>
  function add_modal() {
    if(allow_email == 1) {
      $('#hidden_id').val($('#tbl_id').val());
      $('#addemail_modal').modal();
    }
  }
 
</script>

@endsection
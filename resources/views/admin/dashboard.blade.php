@extends('admin_layout')
@section('admin_content')  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <div id="ph_div"></div>

                <p>PH</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="/chartph" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <div id="cl_div"></div>

                <p>Chlorine</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="/chartch" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <div id="tem_div"></div>

                <p>Temperature</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="/charttem" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <div id="orp_div"></div>
                <p>ORP</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="/chartorp" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">

          <!-- Left col -->
          <section class="col-lg-12 ">

            <div class="card">
               <div class="card-header">
                <h3 class="card-title">ORP </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" id="selectError"  findval1="PH" findval2="ORP" findval3="TEMP" findval4="CL" findval5="TOTAL_CL"  findval6="COMB_CL" xmlval="xmlfiles/xmlfile202001.XML" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button> 
                                
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>

            <div class="card">
               <div class="card-header">
                <h3 class="card-title">Chlorines </h3>               
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="cl3Chart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>


            <!-- BAR CHART -->
              <div class="col-md-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">PH  ORP  Temperature  Chlorine</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>                 
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>         

          </section>
        </div>
      
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  @endsection
  @section('admin_footer')
<script src="/public/plugins/chart.js/Chart.min.js"></script>
<script src="/public/upload/chart2.js"></script>
@endsection

@extends('admin_layout')
@section('admin_content') 
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PH  ORP  Temperature  Chlorine</h1>
          </div>
          
          <div class="col-sm-6">
            <div class="form-group">
                <button class="btn btn-success" id="selectError" name="file_url" findval1="PH" findval2="ORP" findval3="TEMP" findval4="CL" xmlval="xmlfiles/xmlfile202001.XML">refresh</button>
              </div>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <section class="content">
      <div class="container-fluid">
          <div class="col-md-12">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">PH  ORP  Temperature  Chlorine</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>                 
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>      
         


            <!-- BAR CHART -->
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">PH and ORP bar diplay Chart</h3>

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

        

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
  


@endsection

@section('admin_footer')
<script src="/public/plugins/chart.js/Chart.min.js"></script>
<script src="/public/upload/chart2.js"></script>
@endsection
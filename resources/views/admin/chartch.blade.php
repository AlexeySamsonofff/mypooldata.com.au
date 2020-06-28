@extends('admin_layout')
@section('admin_content')   

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{$title}}</h1>
        </div>
        
        <div class="col-sm-6">
          <div class="form-group">
            <button class="btn btn-success" id="selectError" name="file_url" findval="{{$findval}}" xmlval="xmlfiles/xmlfile202001.XML">refresh</button>
            </div>
        </div>          
      </div>
    </div><!-- /.container-fluid -->
 </section>


   <section class="content">
      <div class="container-fluid">
          <div class="col-md-12">
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">{{$title}}</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>                 
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="areaChart1" style="min-height: 550px; height: 550px; max-height: 550px; max-width: 100%;"></canvas>
                  </div>
                </div>
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
<script src="/public/upload/admin_chart.js"></script>
@endsection

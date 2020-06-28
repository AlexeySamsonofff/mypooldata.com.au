@extends('admin_layout')
@section('admin_content')

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Realtime active chart</h1>
          </div>

           <div class="col-sm-6">
            <div class="form-group">
                <select id="selectError" class="form-control select2bs4"  data-rel="chosen" name="file_url">                   
                    <option value="xmlfiles/xmlfile202001.XML">display</option>                    
                </select>
              </div>
          </div>    
        </div>
      </div><!-- /.container-fluid -->
    </section>


   <section class="content">
	<div>
		<canvas id="myChart"></canvas>
	</div>	
	  </section>
@endsection

@section('admin_footer')
<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.8.0"></script>

<script src="/public/upload/realchart.js"></script>
@endsection

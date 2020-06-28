@include('header')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   @if(Session::has('email'))      
      <span class="info-box mb-3 bg-secondary">
        <i class="nav-icon fas fa-chart-pie"></i>
      {{Session::get('pool_name')}}</span>
    @endif

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('public/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Session::get('name')}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/usertable" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Usertable
              </p>
            </a>
          </li>
       <!--     <li class="nav-item has-treeview">
            <a href="/realchart" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Real time chart
              </p>
            </a>
          </li>          
 -->
          <li class="nav-item has-treeview">
            <a href="/chartph" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                PH detail chart
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/chartorp" class="nav-link">
              <i class="nav-icon fas fa-chart-area"></i>
              <p>
                ORP detail chart
              </p>
            </a>
          </li>          
         
          <li class="nav-item has-treeview">
            <a href="/charttem" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Temperature detail chart
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/chartch" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Chlorine detail chart
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/chartch_t" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Total Chlorine  chart
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/chartch_c" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                comb Chlorine  chart
              </p>
            </a>
          </li>




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    @yield('admin_content')
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-update">  
  <div class="modal-dialog">
      
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/update_user" method="post">
        @csrf
          <fieldset>
            <div class="modal-body">   
              <input type="hidden" name="userid" id="userid">     
                <div class="form-group row">                  
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" id="username" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Pool Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="pool_name" class="form-control" id="pool_name" >
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Machine ID</label>
                  <div class="col-sm-10">
                    <input type="text" name="machine_id" class="form-control" id="machine_id" >
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label" >Timezone</label>
                  <div class="col-sm-10">
                    <select class="browser-default custom-select" name="yourTimezone" id="yourTimezone">
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
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
              <button type="submit" class="btn btn-primary" id="savebtn" >Update</button>
            </div>
        </fieldset>
      </form>
    </div>
 
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>SwimmingPool    <br><a href="#">SwimmingPool.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/public/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/public/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>




<script src="/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/public/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/public/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- <script src="/public/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="/public/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/public/plugins/moment/moment.min.js"></script>
<script src="/public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/public/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/public/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/public/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/public/dist/js/demo.js"></script>

 @yield('admin_footer')

<script type="text/javascript">
  function delete_user(obj) {
    if(confirm(("Would you delete this user?")))
    {
      $.get(
        '/delete/'+$(obj).attr('id'),
        function(){
          $(obj).parent().parent().remove();
        });
    }
  }
    function delete_file(obj){
      if(confirm("Would you delete this xmlfile?")){
        $.get(
          '/delete_xml/'+$(obj).attr('id'),
          function(data){
            alert(data);
            $(obj).parent().parent().remove();
          }
          )
      }
    }

    function update_modal(obj){
      //  alert(obj.id);
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          url: '/main_pool/' + obj.id,
          dataType: "JSON",
          success: function (data) {
              pool_info =data['pool_info'];
              console.log("update_date = ", pool_info);
              $('#userid').val(obj.id);
              $('#username').val(pool_info[0].name);
              $('#machine_id').val(pool_info[0].machine_id);
              $('#pool_name').val(pool_info[0].pool_name);
              $('#yourTimezone').val(pool_info[0].yourtimezone);
              $('#modal-update').modal();
          }
    
      }) 
      //  var first_obj=$("#"+obj.id).parent().parent().children().first();
      //  var username =first_obj.next().next().text();
      //  var pool_name =first_obj.next().next().next().next().text();
      //  var machine_id =first_obj.next().next().next().next().next().text();     
      //  $('#userid').val(obj.id);
      //  $('#username').val(username);
      //  $('#machine_id').val(machine_id);
      //  $('#pool_name').val(pool_name);
      //  $('#modal-update').modal();
    }
    



</script>


</body>
</html>

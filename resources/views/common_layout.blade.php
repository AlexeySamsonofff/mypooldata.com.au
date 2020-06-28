 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>swimming pool</title>
     <!-- Tell the browser to be responsive to screen width -->
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="/public/plugins/fontawesome-free/css/all.min.css">
     <!-- Ionicons -->
     <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
     <!-- Tempusdominus Bbootstrap 4 -->
     <link rel="stylesheet" href="/public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
     <!-- daterange picker -->
     <link rel="stylesheet" href="/public/plugins/daterangepicker/daterangepicker.css">
     <!-- iCheck -->
     <link rel="stylesheet" href="/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

     <!-- Theme style -->
     <link rel="stylesheet" href="/public/dist/css/adminlte.min.css">

     <!-- summernote -->
     <link rel="stylesheet" href="/public/plugins/summernote/summernote-bs4.css">
     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

     <link rel="stylesheet" type="text/css" href="/public/upload/css/jquery.jqChart.css" />
     <link rel="stylesheet" type="text/css" href="/public/upload/themes/le-frog/styles.css" />
     <!-- overlayScrollbars -->
     <link rel="stylesheet" href="/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
     <link rel="stylesheet" type="text/css" href="/public/upload/css/component.css" />
 </head>

 <body class="hold-transition layout-top-nav">
     <div class="wrapper">

         <!-- Navbar -->
         <nav class="main-header navbar-expand-md mynavbar">
             <div class="container">
                 <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>

                 <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                     <!-- Left navbar links -->
                     <ul class="navbar-nav">
                         <?php
                            $email = Session::get('email');
                            $id = DB::table('users')->select('id')->where('email', $email)->first()->id;
                            $main_info =DB::table('users')->select('machine_id')->where('id',$id)->first();

                            $user_info = DB::table('tbl_user')->where('user_id', $id)->get();
                            ?>
                         <li class="nav-item dropdown" id="select_pool"  findval0="PH" findval1="ORP" findval2="TEMP" findval3="CL" findval4="TOTAL_CL" findval5="COMB_CL"  pool_id="{{$id}}" title="{{$main_info->machine_id}}" xmlval="xmlfiles/xmlfile202001.XML">
                             <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle nav-title">POOL</a>
                             <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li pool_id="{{ $id}}" title="{{$main_info->machine_id}}" data-pool="main" ><span  class="dropdown-item">{{Session::get('pool_name')}} </span></li>
                                 @foreach($user_info as $user_i)
                                 <li pool_id="{{ $user_i->tbl_id}}"  title="{{$user_i->machine_id}}" data-pool="other" ><span  class="dropdown-item">{{$user_i->pool_name}} </span></li>
                                 @endforeach
                             </ul>
                         </li>
                         <li class="nav-item dropdown"  >
                             <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle nav-title">DETAILED GRAPHS</a>
                             <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                 <li ><span><a href="/common_chartph" class="nav-link">PH </a></span></li>
                                 <li class="nav-item"><a href="/common_chartorp" class="nav-link">ORP</a></li>
                                 <li ><a href="/common_charttem" class="nav-link">Temperature</a></li>
                                 <li><a href="/common_chartch" class="nav-link ">Chlorine</a></li>
                                 <li><a href="/common_chartch_t" class="nav-link">Chlorine total</a></li>
                                 <li><a href="/common_chartch_c" class="nav-link">Chlorine Combined</a></li> 
                             </ul>
                         </li>
                         <li class="nav-item">
                             <a href="/common" id="mainpool" title="{{Session::get('pool_name')}}" class="nav-link nav-title">DASHBOARD</a>
                         </li>
                         
                         <li class="nav-item">
                             <a href="/history" id="mainpool" title="{{Session::get('pool_name')}}" class="nav-link nav-title">HISTORY</a>
                         </li> 
                         <li class="nav-item dropdown"  >
                             <a id="ServiceDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle nav-title">SUPPORT</a>
                             <ul  class="dropdown-menu dropdown-menu-lg border-0 shadow">
                                 <li><a href="http://brauerindustries.com/contact-us/" class="nav-link">Place orders for Consumables</a></li>
                                 <div class="dropdown-divider"></div>
                                 <li><a href="http://brauerindustries.com/contact-us/" class="nav-link">Request a Service Call total</a></li>
                                 <div class="dropdown-divider"></div>
                                 <li><a href="http://brauerindustries.com/contact-us/" class="nav-link">Update User Details</a></li> 
                                 <div class="dropdown-divider"></div>
                                 <li><a href="http://brauerindustries.com/contact-us/" class="nav-link">Update Subscription Details</a></li> 
                                 <div class="dropdown-divider"></div>
                                 <li><a href="http://brauerindustries.com/contact-us/" class="nav-link">Support videos / manuals / forum</a></li> 
                             </ul>
                         </li> 
                         @if(Session::has('email'))
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                Welcome <span class="btn btn-success"> {{Session::get('name')}} <i class="fas fa-user"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <div class="dropdown-divider"></div>
                                <a href="/logout" class="dropdown-item">
                                    <i class="fas fa-user "></i> logout
                                </a>

                            </div>
                        </li>

                     @endif                      
                     </ul>


                 </div>
             
             </div>
         </nav>
         <!-- /.navbar -->


         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">


             <!-- Main content -->
             @yield('common_content')
             <!-- /.content -->
         </div>

         <!-- /.content-wrapper -->

         <!-- ***** Footer Area Start ***** -->
         @yield('common_footer')



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
   
     <!-- jQuery Knob Chart -->
     <script src="/public/plugins/jquery-knob/jquery.knob.min.js"></script>
    
     <!-- Select2 -->
    <script src="/public/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="/public/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="/public/plugins/moment/moment.min.js"></script>
    <script src="/public/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
     <!-- daterangepicker -->
     <script src="/public/plugins/daterangepicker/daterangepicker.js"></script>
     <!-- Tempusdominus Bootstrap 4 -->
     <script src="/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
     <!-- Summernote -->
     <script src="/public/plugins/summernote/summernote-bs4.min.js"></script>
     <!-- overlayScrollbars -->
     <script src="/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
     <!-- AdminLTE App -->
     <script src="/public/dist/js/adminlte.js"></script>   
     @yield('common_js')

 </body>

 </html>
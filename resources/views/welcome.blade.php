<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>swimmingpool | login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/public/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/public/upload/css/component.css">
  <!-- <style type="text/css">
        body { background: url(/public/img/w7.jpg) !important; }
    </style> -->
</head>

<body class="hold-transition login-page bgimg" >
<div class="login-box logimg">
  <div class="login-logo">
    <a href="#"><b>WELCOME</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card logimg" >
    <div class="card-body ">
      <p class="login-box-msg">Sign in to start your session</p>
       @if ($message = Session::get('error'))
       <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
       </div>
       @endif
       @if ($message = Session::get('wait'))
       <div class="alert alert-primary alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
       </div>
       @endif

       @if (count($errors) > 0)
        <div class="alert alert-danger">
         <ul>
         @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
         @endforeach
         </ul>
        </div>
       @endif

      <form action="/login" method="post">
        @csrf
        <fieldset>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email"  name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
           
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </fieldset>
      </form>

      <!-- /.social-auth-links -->

     <!--  <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        
         <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#"><i class="far fa-plus-square "></i>
                  WELCOME +
          </button>
        
      </div>
 -->
     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->




<!-- jQuery -->
<script src="/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/public/dist/js/adminlte.min.js"></script>

</body>
</html>

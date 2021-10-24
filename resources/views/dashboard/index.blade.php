<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{asset('dist/img/AdminLTELogo.png')}}" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" />
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
 <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
    html
        {
            font-size: 100%;
        }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/')}}" class="nav-link">Home</a>
        @if(Auth::user()->role)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('adminHome') }}">{{ __('AdminArea') }}</a>
            </li>
        @endif
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('contact')}}" class="nav-link">Contact</a>
      </li>

    </ul>
    <?php
         $messages = App\Message::where([['messagetype','=',true],['readstatus','=',true],['userid','=',Auth::user()->id]])->take(10)->get();
         $messageNo = App\Message::where([['messagetype','=',true],['readstatus','=',true],['userid','=',Auth::user()->id]])->count();
         ?>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{$messageNo}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          @foreach($messages as $message)
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Academia
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">{{$message->message}}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{$message->created_at}}</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
          
          <div class="dropdown-divider"></div>
          <a href="{{route('userInbox')}}" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-cogs"></i>
        </a>
      </li>
       <!-- logout -->
       <li> <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            {{Auth::user()->name}}
            </button>
        <div class="dropdown-menu" aria-labelledby="triggerId">
        <form action="{{route('logout')}}" method="post">
          @csrf
          <button class="dropdown-item" type="submit">Logout</button>
          </form>
        </div>
      </div></li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Academia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php 
            $avatar = App\Profile::where('userid',Auth::user()->id)->value('avatar');

          ?>
          <img src="{{asset('images/avatar/'.$avatar)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/home" class="d-block"> {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fa fa-user-circle nav-icon" aria-hidden="true"></i>
              <p>
                Profile
                @if(!App\Profile::where('userid',Auth::user()->id)->value('status'))
                <span class="ml-2 badge badge-danger">update??</span>
                @endif
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('myprofile')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('profile')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Programs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('programmes','degree')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Degree Programs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('programmes','diploma')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diploma Programs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('programmes','certificate')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Certificate Programs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('programmes','artisan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Artisan Programs</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="fas fa-school nav-icon "></i>
              <p>
                Institutions
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('uni')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Universities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('cole')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Colleges</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
          <a href="{{route('userProgam')}}" class="nav-link">
             <i class="fa fa-comments nav-icon" aria-hidden="true"></i>
              <p>
              Course Advisory
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="{{route('basket')}}" class="nav-link" >
              <i class="fa fa-shopping-basket nav-icon" aria-hidden="true"></i>
              <p>
              Course Basket
              <span class="right badge badge-success">{{App\Program::where('userid',Auth::user()->id)->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="fa fa-envelope" aria-hidden="true"></i>
              <p>
                Messages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('userInbox')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('userSentMessages')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Outbox</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
          <a href="#" class="nav-link" data-widget="control-sidebar" data-slide="true">
              <i class="nav-icon fas fa-cog"></i>
              <p>
              Settings
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
   <div class="row justify-content-center">
   @if(!App\Profile::where('userid',Auth::user()->id)->value('status'))
    <div class="alert alert-info col-md-8 my-2">
      <strong>Please Complete your profile to allow ease use of the service. <a href="{{route('profile')}}">COMPLETE PROFILE</a></strong>
    </div>
  @endif
 @if(session()->has('success'))
    <div class="alert alert-success col-md-8 mt-2">
        {{ session()->get('success') }}
    </div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger col-md-8 mt-2">
        {{ session()->get('error') }}
    </div>
@endif
   </div>
 
    @yield('content')
 </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://cagifire.com">Cagifire</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2-pre
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
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('js/main/select.js')}}"></script>
<script src="{{asset('js/main/jquery.PrintArea.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/core.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"></script>
 
 <script>
 $(document).ready( function () {
  $("#input-id").rating();
    $('#mytable,#mytable2').DataTable();
} );
  </script>

<script>
    $("#print_button").click(function(){
      var options = { mode : "popup", popClose : true,popHt: 700,popWd: 900,popX: 300, popY: 150,};
    $(".PrintArea").printArea( options );
});
</script>

</body>
</html>

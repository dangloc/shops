<!DOCTYPE html>
<html lang="en">
<head>
 @include('admin.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
    <ul class="navbar-nav ml-auto"> 
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user fa-fw"></i>
          Xin chào: <b>{{Auth::user()->fullname}}</b>
          <i class="fas fa-chevron-down"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-user fa-fw"></i> Quản lí nhân viên

          </a>
          <div class="dropdown-divider"></div>
          <a href="{{url('admin/staff/profile')}}" class="dropdown-item">
            <i class="fas fa-user-edit fa-fw"></i> Thông tin tài khoản

          </a>

          <div class="dropdown-divider"></div>
          <a href="{{url('admin/users/logout')}}" class="dropdown-item dropdown-footer">Thoát</a>
        </div>
      </li>
    </ul>
  </nav>
  @include('admin.sidebar')

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        @include('admin.alert')
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary mt-3">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3> 
              </div>
             @yield('content')
            </div>
            </div>
          <div class="col-md-6">
          </div>
        </div>
      </div>
    </section>
  </div>


  
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

 
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('admin.footer')
</body>
</html>
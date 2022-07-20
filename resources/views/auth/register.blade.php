<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head');
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Register</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
      @include('admin.alert')
      <form action="/auth/register/storeRegister" method="post">
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="re_password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        @csrf
      </form>

      <a href="/auth/login" class="text-center">I already have a membership</a>
    </div>
 
  </div>
</div>

@include('admin.footer')
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('template-admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('template-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template-admin/dist/css/adminlte.min.css')}}">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('template-admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('template-admin/plugins/toastr/toastr.min.css')}}">
</head>
<style>
  .login-page,
  .register-page {
    background-color: none;
    background-image: url('gambar/banner.png');

    /* Full height */
    width: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .login-banner img {
    background-color: none;
    /* background-image: url('gambar/logo.png'); */

    /* Full height */
    width: 33%;
    margin: 0px 33% 10PX 33%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-banner">
      <img src="{{ asset('gambar/logo.png') }}" alt="" srcset="">
    </div>
    <div class="login-logo">
      <a href="#"><b>Login</b> Admin/Pelatih</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Masuk untuk memulai sesi anda</p>
        <form action="/admin" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="user_username" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                  Ingat Saya
                </label>
              </div>
            </div>
          </div>
          <div class="social-auth-links text-center mb-3">
            <button class="btn btn-block btn-info" name="masuk">
              Masuk
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="template-admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="template-admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="template-admin/dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="template-admin/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="template-admin/plugins/toastr/toastr.min.js"></script>
</body>

</html>
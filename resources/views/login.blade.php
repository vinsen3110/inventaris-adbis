<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Inventaris</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f7f7f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      color: #333;
    }

    .login-container {
      width: 100%;
      max-width: 400px;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-header h2 {
      font-size: 24px;
      font-weight: bold;
      color: #0056b3;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: 600;
      font-size: 14px;
      color: #555;
      display: block;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
    }

    .form-group input:focus {
      outline: none;
      border-color: #0056b3;
    }

    .form-group .error-message {
      color: red;
      font-size: 12px;
      margin-top: 5px;
    }

    .btn-submit {
      width: 100%;
      padding: 12px;
      background: #0056b3;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-submit:hover {
      background: #004085;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .footer a {
      color: #0056b3;
      text-decoration: none;
    }
  </style>
</head>
<body>
<div class="background" style="
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background-image: url('{{ asset('ta/template/assets/images/auth/image.png') }}');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  z-index: 0;
"></div>
<div style="z-index: 99999; background-color: rgba(255, 255, 255, 0.425); " class="login-container mb-5 ">
  <div class="login-header">
    <img style="width: 70px; border-radius: 50%;" src="{{asset('ta/template/assets/images/auth/logo.png')}}" alt="">
    <h2>Login Inventaris</h2>
    <p>Selamat datang, silakan login untuk mengakses sistem Inventaris.</p>
  </div>

  @if($errors->any())
    <div class="form-group">
      <p class="error-message">{{ $errors->first() }}</p>
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>

    <button type="submit" class="btn-submit">Login</button>
  </form>

  <div class="footer">
    <p>Belum memiliki akun? <a href="#">Daftar disini</a></p>
  </div>
</div>


</body>
</html>


{{-- <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('ta/template/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('ta/template/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('ta/template/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('ta/template/assets/images/favicon.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Login</h3>
                @if($errors->any())
    <div class="form-group">
      <p class="error-message">{{ $errors->first() }}</p>
    </div>
  @endif
                 <form method="POST" action="{{ route('login') }}">
    @csrf
                  <div class="form-group">
                    <label>Username or email *</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}" required>
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                   <input type="password" id="password" name="password" required>
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="#" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook mr-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('../../../assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('../../../assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('../../../assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('../../../assets/js/misc.js')}}"></script>
    <script src="{{asset('../../../assets/js/settings.js')}}"></script>
    <script src="{{asset('../../../assets/js/todolist.js')}}"></script>
    <!-- endinject -->
  </body>
</html> --}}
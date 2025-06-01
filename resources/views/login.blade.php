<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Inventaris</title>
    <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <div class="background"
        style="
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background-image: url('{{ asset('img/bg-poliban.jpg') }}');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  z-index: 0;
">
    </div>
    <div style="z-index: 99999; background-color: rgba(255, 255, 255, 0.425); " class="login-container mb-5 ">
        <div class="login-header">
            <img style="width: 70px; border-radius: 50%;" src="{{ asset('ta/assets/images/logos/image.png') }}"
                alt="">
            <h2>SIMBAN</h2>
            <p>Selamat datang, silakan login untuk mengakses sistem Inventaris.</p>
        </div>

        @if (session('status'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif



        <form method="POST" action="{{ route('login.proses') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>



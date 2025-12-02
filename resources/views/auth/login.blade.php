<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">

  <!-- Custom Style -->
  <style>
    body {
      height: 100vh;
      margin: 0;
      font-family: Calibri, "Segoe UI", sans-serif;
      background: #001f2d;
      /* warna dasar gelap elegan */
      overflow: hidden;
    }

    /* Aurora Layer */
    .aurora {
      
      position: absolute;
      width: 120%;
      height: 120%;
      top: -10%;
      left: -10%;
      background: radial-gradient(circle at 20% 30%, rgba(0, 255, 255, 0.4), transparent 60%),
        radial-gradient(circle at 80% 20%, rgba(0, 150, 255, 0.35), transparent 60%),
        radial-gradient(circle at 60% 80%, rgba(0, 200, 255, 0.35), transparent 60%),
        radial-gradient(circle at 30% 70%, rgba(0, 255, 200, 0.3), transparent 70%);
      filter: blur(120px);
      animation: auroraMove 18s infinite alternate ease-in-out;
    }

    /* Animasi lembut aurora */
    @keyframes auroraMove {
      0% {
        transform: translate(-30px, -20px) scale(1);
      }

      50% {
        transform: translate(50px, 40px) scale(1.1);
      }

      100% {
        transform: translate(-20px, 60px) scale(1);
      }
    }

    /* CARD GLASS */
    .login-card {
      position: relative;
      /* agar z-index bekerja */
      z-index: 2;
      width: 400px;
      padding: 35px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.18);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border: 1px solid rgba(255, 255, 255, 0.35);
      box-shadow: 0 8px 28px rgba(0, 0, 0, 0.25);
    }

    .login-title {
      color: #ffffff;
      font-weight: bold;
    }

    .form-label {
      font-weight: 600;
      color: #ffffff;
    }

    .form-control {
      border-radius: 12px;
      padding: 10px;
    }

    .btn-login {
      background: #ffffff;
      color: #0277BD;
      border-radius: 12px;
      padding: 10px;
      font-weight: bold;
    }

    .btn-login:hover {
      background: #e7e7e7;
    }

    .logo {
      width: 140px;
      margin-bottom: -50px;
    }

    .login-card {
      padding: 20px 35px 35px 35px;
    }
  </style>

</head>

<body class="d-flex justify-content-center align-items-center">


  <div class="login-card text-center">




    <!-- LOGO -->
    <img src="{{ asset('storage/logo/logo-putih.png') }}" alt="Logo" width="200">

    @if ($errors->any())
    <div class="alert alert-danger small">
      {{ $errors->first() }}
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success small">{{ session('success') }}</div>
    @endif

    <form action="{{ route('login.proses') }}" method="POST" class="text-start">
      @csrf

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>


      <button type="submit" class="btn btn-login w-100">
        Sign In
      </button>
    </form>
    <div class="aurora"></div>


  </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RS Selalu Sehat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0f62fe;
            --dark-blue: #002d9c;
            --bg-gradient: linear-gradient(135deg, #f5f8ff 0%, #e0e9f6 100%);
            --text-dark: #161616;
            --white: #ffffff;
        }

        body {
            background: var(--bg-gradient);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            overflow: hidden;
            margin: 0;
            position: relative;
        }

        /* Dekorasi Latar Belakang */
        body::before, body::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: var(--primary-blue);
            opacity: 0.05;
            z-index: -1;
        }
        body::before { top: -50px; left: -50px; }
        body::after { bottom: -50px; right: -50px; }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 45px 35px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 45, 156, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header .logo-icon {
            width: 64px;
            height: 64px;
            background: var(--primary-blue);
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 15px;
            box-shadow: 0 8px 16px rgba(15, 98, 254, 0.3);
        }

        .login-header h2 {
            font-weight: 800;
            color: var(--text-dark);
            font-size: 1.6rem;
            letter-spacing: -0.5px;
        }

        .login-header p {
            color: #6f6f6f;
            font-size: 0.9rem;
        }

        /* --- Input Styling --- */
        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group-custom i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a8a8a8;
            transition: 0.3s;
        }

        .form-control-custom {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border-radius: 12px;
            border: 2px solid #edf2f7;
            background: #f8fafc;
            font-weight: 500;
            transition: all 0.3s;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--primary-blue);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(15, 98, 254, 0.1);
        }

        .form-control-custom:focus + i {
            color: var(--primary-blue);
        }

        /* --- Button Styling --- */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 45, 156, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* --- Error Alert --- */
        .alert-custom {
            background: #fff5f5;
            color: #c53030;
            border: 1px solid #feb2b2;
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            text-decoration: none;
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .back-link:hover {
            color: var(--dark-blue);
            text-decoration: underline;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <div class="login-header">
            <div class="logo-icon">
                <i class="fas fa-hospital-alt"></i>
            </div>
            <h2>Portal Staff</h2>
            <p>Silakan masuk untuk mengelola antrian</p>
        </div>

        @if ($errors->any())
            <div class="alert-custom">
                <i class="fas fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="input-group-custom">
                <input type="email" name="email" class="form-control-custom" placeholder="Email Pengguna" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <i class="fas fa-envelope"></i>
            </div>

            <div class="input-group-custom">
                <input type="password" name="password" class="form-control-custom" placeholder="Kata Sandi" required autocomplete="current-password">
                <i class="fas fa-lock"></i>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 px-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <span>Masuk ke Sistem</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <a href="/" class="back-link">
            <i class="fas fa-chevron-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
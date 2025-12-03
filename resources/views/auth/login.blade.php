<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Antrian RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- VARIABLE COLORS --- */
        :root {
            --primary-color: #0d6efd; /* Biru Utama */
            --primary-dark: #0a58ca;
            --bg-light: #f5f8ff; /* Latar Belakang Konten (Mirip Dashboard) */
            --text-dark: #1f375f;
            --card-bg: #ffffff;
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            --border-color: #ced4da;
        }

        body {
            background: var(--bg-light);
            /* Menggunakan display flex untuk menengahkan konten vertikal dan horizontal */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        .login-box {
            width: 100%;
            max-width: 400px; /* Lebar maksimum yang lebih modern */
            padding: 40px;
            background: var(--card-bg);
            border-radius: 15px;
            box-shadow: var(--shadow);
            border: 1px solid #e0e9f6;
            animation: fadeIn 0.8s ease-out; /* Animasi masuk */
        }

        .login-box h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* --- INPUT FIELD STYLING --- */
        .form-control-custom {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 1rem;
        }
        .form-control-custom:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* --- BUTTON STYLING --- */
        .btn-custom {
            width: 100%;
            padding: 12px;
            background: var(--primary-color);
            border: none;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: background 0.3s;
        }

        .btn-custom:hover {
            background: var(--primary-dark);
        }

        /* --- ERROR MESSAGE --- */
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>

</head>
<body>

<div class="login-box">
    <h2><i class="fas fa-hospital-user me-3"></i> Login Sistem Antrian</h2>

    @if ($errors->any())
        <div class="alert-error">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" class="form-control-custom" placeholder="Email Pengguna" value="{{ old('email') }}" required autocomplete="email">

        <input type="password" name="password" class="form-control-custom" placeholder="Kata Sandi" required autocomplete="current-password">

        <button type="submit" class="btn-custom">
            <i class="fas fa-sign-in-alt me-2"></i> Masuk
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
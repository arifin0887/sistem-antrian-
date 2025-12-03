<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            background: #E3F2FD;
            font-family: Arial, Helvetica, sans-serif;
        }

        .login-box {
            width: 350px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: white;
            border-radius: 5px;
        }

        button:hover {
            background: #0056B3;
        }
    </style>

</head>
<body>

<div class="login-box">
    <h2 style="text-align:center; color:#033E8C;">Login Sistem Antrian</h2>

    @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrian RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #0d6efd; 
            --secondary-color: #1f375f; 
            --bg-light: #f5f8ff; 
            --sidebar-width: 260px;
        }

        body {
            background: var(--bg-light);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: var(--primary-color);
            color: white;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .sidebar-brand {
            padding: 20px 20px 30px 20px;
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
            text-align: center;
        }
        
        .sidebar-menu a {
            color: #ffffffd0; 
            text-decoration: none;
            padding: 12px 25px;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            transition: background 0.2s, color 0.2s;
            border-left: 5px solid transparent;
        }
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.2);
            color: white;
            border-left: 5px solid white; 
        }
        .sidebar-menu a i {
            width: 25px; 
            margin-right: 10px;
        }

        .navbar {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
            height: 60px !important;
        }

        .navbar .nav-link {
            padding: 5px 10px;
        }

        .dropdown-menu {
            margin-top: 10px !important;
        }

        .navbar {
            left: var(--sidebar-width);
            right: 0;
            top: 0;
            z-index: 1000;
            padding: 0.75rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s;
        }
        .navbar-brand {
            color: var(--secondary-color) !important;
            font-weight: 600;
        }
        
        .content {
            margin-left: var(--sidebar-width);
            padding: 80px 30px 30px 30px; 
            transition: all 0.3s;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 300px;
                transform: translateX(-100%);
                z-index: 1030; 
            }
            .content,
            .navbar {
                margin-left: 0;
                left: 0;
            }
            .navbar .navbar-brand {
                display: none; 
            }
        }
    </style>

</head>
<body>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Web Saya</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        
        /* Gaya Navigation Bar */
        nav { 
            background: #333; 
            color: white; 
            padding: 15px 40px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .logo { font-size: 20px; font-weight: bold; letter-spacing: 1px; }
        
        .nav-links { display: flex; gap: 20px; }
        
        .nav-links a { 
            color: white; 
            text-decoration: none; 
            padding: 8px 15px; 
            border-radius: 5px; 
            transition: 0.3s;
        }

        /* Tombol Login (Hijau) */
        .btn-login { background-color: #28a745; }
        .btn-login:hover { background-color: #218838; }

        /* Tombol Register (Biru) */
        .btn-register { background-color: #007bff; }
        .btn-register:hover { background-color: #0069d9; }

        /* Konten Utama */
        .hero {
            text-align: center;
            padding: 100px 20px;
            background: white;
            margin: 50px auto;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        h1 { color: #333; margin-bottom: 20px; }
        p { color: #666; font-size: 18px; line-height: 1.6; }
    </style>
</head>
<body>

<nav>
    <div class="logo">Web Saya</div>
    <div class="nav-links">
        <a href="login.php" class="btn-login">Login</a>
        <a href="register.php" class="btn-register">Register</a>
    </div>
</nav>

<div class="hero">
    <h1>Selamat Datang di Sistem Kami</h1>
    <p>
        Silakan <strong>Daftar</strong> jika Anda belum memiliki akun, <br> 
        atau langsung <strong>Login</strong> untuk mengakses fitur dashboard kami.
    </p>
</div>

</body>
</html>

<?php 
session_start();
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; }
        .card { width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        input { width: 100%; margin-bottom: 10px; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: green; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Masuk</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>

    <?php
    if (isset($_POST['login'])) {
        // Mengamankan input dari SQL Injection dasar
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];

        // PERBAIKAN 1: Ubah 'username' menjadi 'namapengguna' di klausa WHERE
        $query = "SELECT * FROM users WHERE namapengguna = '$username'";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            $user = mysqli_fetch_assoc($result);

            // PERBAIKAN 2: Ubah $user['password'] menjadi $user['pw']
            if ($user && password_verify($password, $user['pw'])) {
                
                // PERBAIKAN 3: Simpan session menggunakan 'namapengguna'
                $_SESSION['namapengguna'] = $user['namapengguna']; 
                $_SESSION['foto'] = $user['foto'];
                
                // Pindah ke halaman dashboard
                header("Location: dashboard.php");
                exit(); // Tambahkan exit setelah header location
            } else {
                echo "<script>alert('Username/Password Salah!');</script>";
            }
        } else {
             echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
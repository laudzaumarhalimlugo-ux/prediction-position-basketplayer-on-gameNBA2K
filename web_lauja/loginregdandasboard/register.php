<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; }
        .card { width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        input { width: 100%; margin-bottom: 10px; padding: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: blue; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Daftar Akun</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <label>Foto Profil:</label>
            <input type="file" name="foto" accept="image/*" required>
            <button type="submit" name="register">Daftar Sekarang</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>

    <?php
    if (isset($_POST['register'])) {
        // Mengambil input dari form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        
        // Olah Foto
        $nama_foto = $_FILES['foto']['name'];
        $tmp_name  = $_FILES['foto']['tmp_name'];
        $ekstensi  = pathinfo($nama_foto, PATHINFO_EXTENSION);
        $nama_unik = $username . "_" . time() . "." . $ekstensi;
        
        // Pastikan folder 'uploads' sudah ada
        if (!is_dir("uploads")) {
            mkdir("uploads");
        }

        // Pindahkan foto ke folder 'uploads'
        if (move_uploaded_file($tmp_name, "uploads/" . $nama_unik)) {
            // PERBAIKAN: Nama kolom disesuaikan dengan gambar (namapengguna, pw, foto)
            $query = "INSERT INTO users (namapengguna, pw, foto) VALUES ('$username', '$password', '$nama_unik')";
            
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Berhasil Daftar!'); window.location='login.php';</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Gagal mengunggah foto!');</script>";
        }
    }
    ?>
</body>
</html>
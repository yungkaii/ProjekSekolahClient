<!DOCTYPE html>
<html>
<head><title>Login Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="width: 400px;">
        <h3 class="text-center mb-4">Login Admin</h3>
        <form action="proses.php" method="POST">
            <?php
            session_start();
            include '../config/koneksi.php';
            if(isset($_POST['login'])){
                $user = $_POST['user'];
                $pass = md5($_POST['pass']);
                $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
                if(mysqli_num_rows($cek) > 0){
                    $_SESSION['admin'] = true;
                    header("Location: dashboard.php");
                } else { echo "<p class='text-danger text-center'>Login Gagal!</p>"; }
            }
            ?>
            <input type="text" name="user" class="form-control mb-3" placeholder="Username" required>
            <input type="password" name="pass" class="form-control mb-3" placeholder="Password" required>
            <button name="login" class="btn btn-primary w-100">Masuk</button>
        </form>
        <div class="text-center mt-3"><a href="../index.php">Kembali ke Web</a></div>
    </div>
</body>
</html>
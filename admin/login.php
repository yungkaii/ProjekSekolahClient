<!DOCTYPE html>
<html>
<<<<<<< HEAD
<head>
    <title>Login Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #6fb1d6, #4a90c2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-box {
            width: 420px;
            background: #f5f7fa;
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .logo-title {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }

        .subtitle {
            font-size: 14px;
            color: #7f8c8d;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 500;
            color: #34495e;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
            background: #e9eef4;
            border: none;
        }

        .form-control:focus {
            box-shadow: none;
            background: #dde6ef;
        }

        .btn-login {
            background: #5aa3d6;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 500;
            color: white;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #4a90c2;
        }

        .footer-text {
            font-size: 13px;
            color: #7f8c8d;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="login-box text-center">

    <div class="logo-title">Bina Karya Admin</div>
    <div class="subtitle">WEB CONTROL PANEL</div>

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
            exit;
        } else {
            echo "<div class='alert alert-danger'>Login Gagal!</div>";
        }
    }
    ?>

    <form action="proses.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="user" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="pass" class="form-control" required>
        </div>

        <button type="submit" name="login" class="btn btn-login w-100">Sign In</button>
    </form>

    <div class="footer-text">
        © <?php echo date("Y"); ?> Admin Panel
    </div>

</div>

</body>
</html>
=======
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
>>>>>>> de354fc30b76cb77a822ce5b1d0cd7fcb2b0f525

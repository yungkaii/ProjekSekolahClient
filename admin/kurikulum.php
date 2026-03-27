<?php
session_start();
include '../config/koneksi.php';
if(!isset($_SESSION['status_login'])){ header('Location: login.php'); exit; }

$file = __DIR__ . '/../assets/content/kurikulum.html';
$msg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $content = $_POST['content'] ?? '';
    file_put_contents($file, $content);
    $msg = 'Perubahan disimpan.';
}
$current = file_exists($file) ? file_get_contents($file) : '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Kurikulum - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --bg-dark: #0f172a; --bg-sidebar: #1e293b; --text-grey: #94a3b8; --text-white: #f8fafc; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); }
        .sidebar { background-color: var(--bg-sidebar); box-shadow: 2px 0 10px rgba(0,0,0,0.3); min-height: 100vh; }
        @media (max-width: 768px) { .sidebar { min-height: auto; margin-bottom: 20px; } .sidebar h4 { display: none; } }
        .nav-link { color: var(--text-grey); margin-bottom: 5px; border-radius: 8px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: rgba(255,255,255,0.1); color:#fff; }
        .nav-link i { margin-right:10px; font-size:1.1rem; }
        .card-custom { background-color: var(--bg-sidebar); border: 1px solid #334155; border-radius:12px; color:white; }
        .form-control { background-color: #334155; border:1px solid #475569; color:white; }
        .form-control:focus { background-color:#334155; color:white; border-color:#0ea5e9; box-shadow:0 0 0 0.25rem rgba(14,165,233,0.25); }
    </style>
</head>
<body class="bg-dark text-white">
<div class="d-flex">
    <?php include __DIR__ . '/dashboard_sidebar.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const link = document.querySelector('a[href="kurikulum.php"]');
            if(link) link.classList.add('active');
        });
    </script>
    <div class="flex-grow-1 p-4">
        <div class="card card-custom p-4 shadow-sm">
            <h3 class="fw-bold">Kelola Kurikulum</h3>
            <?php if($msg): ?><div class="alert alert-success"><?= $msg ?></div><?php endif; ?>
            <form method="post">
            <div class="mb-3">
                <label class="form-label">Konten (HTML)</label>
                <textarea name="content" rows="12" class="form-control bg-secondary text-white"><?= htmlspecialchars($current) ?></textarea>
            </div>
            <button class="btn btn-success">Simpan</button>
        </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

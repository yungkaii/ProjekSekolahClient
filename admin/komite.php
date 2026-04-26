<?php
session_start();
include '../config/koneksi.php';
if(!isset($_SESSION['status_login'])){ header('Location: login.php'); exit; }

$file = __DIR__ . '/../assets/content/komite.html';
$msg = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_FILES['komite_img']) && $_FILES['komite_img']['error'] === 0){
        $nama_file = $_FILES['komite_img']['name'];
        $tmp_name = $_FILES['komite_img']['tmp_name'];
        $folder_tujuan = '../assets/content/';
        
        if(move_uploaded_file($tmp_name, $folder_tujuan . $nama_file)){
            // TRIKNYA DISINI: Kita simpan path yang bisa dibaca dari halaman UTAMA
            // Kita pakai path relatif dari root/index.php
            $path_untuk_user = 'assets/content/'.$nama_file; 
            $tag_img = '<img src="'.$path_untuk_user.'" class="img-fluid w-100" alt="Komite Sekolah">';
            
            file_put_contents($file, $tag_img);
            $msg = 'Gambar komite berhasil diperbarui!';
        }
    }
}
$current = file_exists($file) ? file_get_contents($file) : '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Komite - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg-dark: #0f172a; --bg-card: #1e293b; --accent: #10b981; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: #f8fafc; margin: 0; }
        
        /* Layout Fixer */
        .main-wrapper {
            margin-left: 280px; 
            padding: 40px;
            min-height: 100vh;
        }

        @media (max-width: 992px) { .main-wrapper { margin-left: 0; padding: 20px; } }

        .card-custom { background-color: var(--bg-card); border: 1px solid #334155; border-radius: 20px; }
        .form-control { background-color: #0f172a !important; border: 1px solid #334155 !important; color: #fff !important; padding: 15px; border-radius: 12px; }
        
        .preview-box {
            background: #0f172a;
            border: 2px dashed #334155;
            border-radius: 15px;
            padding: 10px;
            margin-bottom: 25px;
            overflow: hidden;
        }
        .preview-box img { max-height: 400px; border-radius: 10px; }
    </style>
</head>
<body>

<div class="d-flex">
    <?php include __DIR__ . '/dashboard_sidebar.php'; ?>

    <div class="main-wrapper flex-grow-1">
        <div class="card card-custom p-4 p-md-5 shadow-lg">
            <div class="mb-4">
                <h2 class="fw-bold mb-1">Struktur Komite Sekolah</h2>
                <p class="text-muted">Ganti gambar mindmap atau struktur organisasi komite di bawah ini.</p>
            </div>

            <?php if($msg): ?>
                <div class="alert alert-success d-flex align-items-center rounded-4 border-0">
                    <i class="bi bi-check-circle-fill me-2"></i> <?= $msg ?>
                </div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data">
                <div class="mb-4 text-center">
                    <label class="form-label d-block text-start fw-bold mb-3">Tampilan Saat Ini:</label>
                    <div class="preview-box">
    <?php
    if(preg_match('/src="([^"]+)"/i', $current, $m)){
        $src = $m[1];
        // Tambahkan ../ hanya untuk tampilan preview di admin saja
        $preview_admin = '../' . $src; 
        echo '<img src="'.htmlspecialchars($preview_admin).'" class="img-fluid" id="current_img">';
    } else {
        echo '<div class="py-5 text-muted"><i class="bi bi-image display-1"></i><br>Belum ada gambar</div>';
    }
    ?>
</div>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-bold mb-3">Pilih Gambar Baru (JPG/PNG):</label>
                    <input type="file" name="komite_img" class="form-control" accept="image/*" required>
                    <div class="form-text text-muted mt-2">Saran: Gunakan gambar dengan lebar minimal 1200px agar terlihat jelas.</div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold py-3">
                        <i class="bi bi-cloud-arrow-up-fill me-2"></i> Update Gambar Komite
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
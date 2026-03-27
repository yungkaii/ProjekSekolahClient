<?php
session_start();
include '../config/koneksi.php';
if(!isset($_SESSION['status_login'])){ header('Location: login.php'); exit; }

$file = __DIR__ . '/../assets/content/sejarah.html';
$msg = '';
$msg_type = '';

// Buat tabel pengaturan jika belum ada
$table_check = mysqli_query($koneksi, "SHOW TABLES LIKE 'pengaturan'");
if(!$table_check || mysqli_num_rows($table_check) == 0){
    mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS pengaturan (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nama_pengaturan VARCHAR(100) UNIQUE,
        nilai TEXT
    )");
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $content = $_POST['content'] ?? '';
    $banner_color = $_POST['banner_color'] ?? '#198754';
    
    file_put_contents($file, $content);
    
    // Simpan warna banner ke database dengan prepared statement
    $check = mysqli_query($koneksi, "SELECT id FROM pengaturan WHERE nama_pengaturan = 'banner_color_sejarah'");
    if($check && mysqli_num_rows($check) > 0){
        $update = mysqli_query($koneksi, "UPDATE pengaturan SET nilai = '".mysqli_real_escape_string($koneksi, $banner_color)."' WHERE nama_pengaturan = 'banner_color_sejarah'");
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO pengaturan (nama_pengaturan, nilai) VALUES ('banner_color_sejarah', '".mysqli_real_escape_string($koneksi, $banner_color)."')");
    }
    
    // Handle upload foto banner
    if($_FILES['banner_foto']['name'] != ""){
        $foto = $_FILES['banner_foto']['name'];
        $tmp = $_FILES['banner_foto']['tmp_name'];
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        $nama_baru = "banner_sejarah_" . date('dmYHis') . "." . $ext;
        $path = "../assets/img/" . $nama_baru;
        
        if(move_uploaded_file($tmp, $path)){
            // Hapus foto lama
            $old_foto = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE nama_pengaturan = 'banner_foto_sejarah'"));
            if($old_foto && file_exists("../assets/img/" . $old_foto['nilai'])){
                @unlink("../assets/img/" . $old_foto['nilai']);
            }
            // Simpan nama foto baru
            $check_foto = mysqli_query($koneksi, "SELECT id FROM pengaturan WHERE nama_pengaturan = 'banner_foto_sejarah'");
            if($check_foto && mysqli_num_rows($check_foto) > 0){
                mysqli_query($koneksi, "UPDATE pengaturan SET nilai = '".mysqli_real_escape_string($koneksi, $nama_baru)."' WHERE nama_pengaturan = 'banner_foto_sejarah'");
            } else {
                mysqli_query($koneksi, "INSERT INTO pengaturan (nama_pengaturan, nilai) VALUES ('banner_foto_sejarah', '".mysqli_real_escape_string($koneksi, $nama_baru)."')");
            }
        }
    }
    
    $msg = 'Perubahan disimpan.';
    $msg_type = 'success';
}

$current = file_exists($file) ? file_get_contents($file) : '';

// Ambil warna banner dari database
$banner_color = '#198754';
$color_query = mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE nama_pengaturan = 'banner_color_sejarah' LIMIT 1");
if($color_query && mysqli_num_rows($color_query) > 0){
    $row = mysqli_fetch_assoc($color_query);
    $banner_color = $row['nilai'];
}

// Ambil foto banner dari database
$banner_foto = '';
$foto_query = mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE nama_pengaturan = 'banner_foto_sejarah' LIMIT 1");
if($foto_query && mysqli_num_rows($foto_query) > 0){
    $row = mysqli_fetch_assoc($foto_query);
    $banner_foto = $row['nilai'];
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Sejarah - Admin</title>
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
        // highlight active link if any
        document.addEventListener('DOMContentLoaded', function(){
            const link = document.querySelector('a[href="sejarah.php"]');
            if(link) link.classList.add('active');
        });
    </script>
    <div class="flex-grow-1 p-4">
        <div class="card card-custom p-4 shadow-sm">
            <h3 class="fw-bold">Kelola Sejarah Sekolah</h3>
            <?php if($msg): ?><div class="alert alert-<?= $msg_type ?>">✓ <?= $msg ?></div><?php endif; ?>
            <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Untuk Mengganti Warna Teks Di Bagian Sejarah (Opsional)</label>
                <div class="d-flex gap-2 align-items-center">
                    <input type="color" name="banner_color" value="<?= htmlspecialchars($banner_color) ?>" class="form-control form-control-color" style="width: 80px; height: 45px;" id="color-input">
                    <input type="text" class="form-control" id="color-hex" value="<?= htmlspecialchars($banner_color) ?>" readonly style="max-width: 150px;">
                </div>
                <small class="text-muted">Pilih warna untuk judul dan garis pemisah</small>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Foto Banner</label>
                <?php if($banner_foto): ?>
                    <div class="mb-2">
                        <img src="../assets/img/<?= htmlspecialchars($banner_foto) ?>" alt="Banner" style="max-height: 200px; border-radius: 8px;">
                        <p class="mt-2 text-muted small">Foto saat ini: <code><?= htmlspecialchars($banner_foto) ?></code></p>
                    </div>
                <?php endif; ?>
                <input type="file" name="banner_foto" class="form-control" accept="image/*">
                <small class="text-muted">Upload foto untuk menampilkan sebagai background banner (jpg, png, gif). Biarkan kosong jika tidak ingin mengubah.</small>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Konten (HTML)</label>
                <textarea name="content" rows="12" class="form-control bg-secondary text-white"><?= htmlspecialchars($current) ?></textarea>
            </div>
            <button class="btn btn-success">Simpan</button>
        </form>
        </div>
    </div>
<script>
document.getElementById('color-input').addEventListener('input', function(){
    document.getElementById('color-hex').value = this.value;
});
</script>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

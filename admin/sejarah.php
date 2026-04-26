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
    
    $msg = 'Perubahan berhasil disimpan.';
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Sejarah - Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --bg-dark: #0f172a; 
            --bg-sidebar: #1e293b; 
            --text-grey: #94a3b8; 
            --text-white: #f8fafc; 
        }
        
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--bg-dark); 
            color: var(--text-white); 
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        .admin-container {
            display: flex;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar-area {
            width: 250px;
            flex-shrink: 0;
            background-color: var(--bg-sidebar);
            height: 100vh;
            overflow-y: auto; 
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
            z-index: 10;
        }

        .content-area {
            flex-grow: 1;
            width: calc(100vw - 250px);
            max-width: calc(100vw - 250px);
            height: 100vh;
            overflow-y: auto; 
            overflow-x: hidden; 
            padding: 2rem;
            min-width: 0; 
        }

        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
                height: auto;
                overflow: visible;
            }
            .sidebar-area {
                width: 100vw;
                height: auto;
            }
            .content-area {
                width: 100vw;
                max-width: 100vw;
                height: auto;
                overflow-y: visible;
                padding: 1rem;
            }
        }
        
        .nav-link { color: var(--text-grey); margin-bottom: 5px; border-radius: 8px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: rgba(255, 255, 255, 0.1); color: #fff; }
        .nav-link i { margin-right: 10px; font-size: 1.1rem; }

        .card-custom { background-color: var(--bg-sidebar); border: 1px solid #334155; border-radius: 12px; color: white; }
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; width: 100%; }
        .form-control:focus { background-color: #334155; color: white; border-color: #0ea5e9; box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25); }
        .form-label { font-weight: 500; color: #cbd5e1; }
        
        input[type="file"]::file-selector-button { background-color: #475569; color: white; border: none; padding: 5px 10px; margin-right: 10px; border-radius: 4px; }
    </style>
</head>
<body>

<div class="admin-container">
    <div class="sidebar-area">
        <?php include __DIR__ . '/dashboard_sidebar.php'; ?>
    </div>

    <div class="content-area">
        <div class="container-fluid p-0">
            <div class="card card-custom p-4 shadow-sm">
                <h3 class="fw-bold mb-4">Kelola Sejarah Sekolah</h3>
                
                <?php if($msg): ?>
                    <div class="alert alert-<?= $msg_type ?> alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> <?= $msg ?>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="form-label">Warna Tema Halaman Sejarah (Opsional)</label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="color" name="banner_color" value="<?= htmlspecialchars($banner_color) ?>" class="form-control form-control-color border-0 p-1" style="width: 60px; height: 40px; cursor: pointer;" id="color-input">
                            <input type="text" class="form-control" id="color-hex" value="<?= htmlspecialchars($banner_color) ?>" readonly style="max-width: 120px;">
                        </div>
                        <small class="text-secondary mt-1 d-block">Pilih warna untuk judul dan elemen desain di halaman sejarah.</small>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Foto Banner Sejarah</label>
                        <?php if($banner_foto): ?>
                            <div class="mb-3 p-3 border border-secondary rounded" style="background-color: #0f172a;">
                                <img src="../assets/img/<?= htmlspecialchars($banner_foto) ?>" alt="Banner" class="img-fluid rounded shadow-sm" style="max-height: 200px; object-fit: cover;">
                                <p class="mt-2 mb-0 text-secondary small">Foto saat ini: <code><?= htmlspecialchars($banner_foto) ?></code></p>
                            </div>
                        <?php endif; ?>
                        <input type="file" name="banner_foto" class="form-control" accept="image/*">
                        <small class="text-secondary mt-1 d-block">Upload foto untuk menampilkan sebagai background banner atas (jpg, png, webp). Biarkan kosong jika tidak ingin mengubah.</small>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Konten Sejarah</label>
                        <textarea name="content" id="ckeditor_content" rows="15" class="form-control"><?= htmlspecialchars($current) ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
// Inisialisasi CKEditor pada textarea
CKEDITOR.replace('ckeditor_content', {
    height: 400, // Atur tinggi editor
    versionCheck: false // INI OBAT PENGHILANG NOTIF MERAHNYA 💊
});

    const path = window.location.pathname.split('/').pop();
    const link = document.querySelector('.sidebar-area a.nav-link[href="'+path+'"]');
    if(link){
        link.classList.add('active');
        const collapseDiv = link.closest('.collapse');
        if(collapseDiv){ new bootstrap.Collapse(collapseDiv,{toggle:false}).show(); }
    }

    document.getElementById('color-input').addEventListener('input', function(){
        document.getElementById('color-hex').value = this.value;
    });
});
</script>
</body>
</html>
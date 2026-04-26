<?php
session_start();
include '../config/koneksi.php';
if(!isset($_SESSION['status_login'])){ header('Location: login.php'); exit; }

$file = __DIR__ . '/../assets/content/kurikulum.html';
$msg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $content = $_POST['content'] ?? '';
    file_put_contents($file, $content);
    $msg = 'Perubahan berhasil disimpan.';
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <style>
        :root { 
            --bg-dark: #0f172a; 
            --bg-sidebar: #1e293b; 
            --text-grey: #94a3b8; 
            --text-white: #f8fafc; 
        }
        
        /* FIX 2: Paksa warna background agar tidak bocor jadi putih */
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--bg-dark) !important; 
            color: var(--text-white) !important; 
        }
        
        /* FIX 3: Tambahkan class untuk menghindar dari Sidebar yang fixed */
        .main-wrapper {
            margin-left: 260px; /* Sesuaikan angka ini dengan lebar sidebar aslimu */
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        /* Responsif untuk layar HP (Sidebar biasanya disembunyikan/di-toggle) */
        @media (max-width: 768px) { 
            .main-wrapper { margin-left: 0; width: 100%; } 
        }

        .card-custom { 
            background-color: var(--bg-sidebar) !important; 
            border: 1px solid #334155; 
            border-radius: 12px; 
            color: white; 
        }
        
        /* Mempercantik CKEditor agar lebih menyatu dengan Dark Mode */
        .cke_chrome { border: 1px solid #475569 !important; }
        .cke_top, .cke_bottom { background: #334155 !important; border-bottom: 1px solid #475569 !important; }
    </style>
</head>
<body>
<div class="d-flex">
    
    <?php include __DIR__ . '/dashboard_sidebar.php'; ?>
    
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const link = document.querySelector('a[href="kurikulum.php"]');
            if(link) link.classList.add('active');
        });
    </script>
    
    <div class="p-4 main-wrapper">
        <div class="card card-custom p-4 shadow-sm">
            <h3 class="fw-bold mb-1">Kelola Konten Kurikulum</h3>
            <p class="text-muted small mb-4">Tuliskan informasi seperti struktur pembelajaran, daftar mata pelajaran, dan visi-misi kurikulum di sini.</p>
            
            <?php if($msg): ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div><?= $msg ?></div>
                </div>
            <?php endif; ?>
            
            <form method="post">
                <div class="mb-4">
                    <label class="form-label fw-medium">Isi Halaman Kurikulum</label>
                    <textarea name="content" id="editorKurikulum" rows="12" class="form-control"><?= htmlspecialchars($current) ?></textarea>
                </div>
                <button class="btn btn-success px-4" type="submit">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Inisialisasi CKEditor
    CKEDITOR.replace('editorKurikulum', {
        height: 400,
        removeButtons: 'Save,NewPage,ExportPdf,Preview,Print,Templates',
        // FIX: Menghilangkan notifikasi "version is not secure"
        versionCheck: false, 
        // Memaksa skin agar icon lebih terlihat
        skin: 'moono-lisa', 
    });

    // CSS Tambahan untuk memaksa icon terlihat dan menghilangkan notifikasi merah secara paksa
    const style = document.createElement('style');
    style.innerHTML = `
        .cke_notification_warning { display: none !important; } /* Sembunyikan notif merah */
        .cke_button_icon { filter: invert(1) brightness(2); } /* Balikkan warna icon agar putih/terang */
        .cke_toolbar_separator { background-color: #475569 !important; }
    `;
    document.head.appendChild(style);
</script>
</body>
</html>
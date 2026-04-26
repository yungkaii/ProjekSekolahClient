<?php
session_start();
include '../config/koneksi.php';
if(!isset($_SESSION['status_login'])){ header('Location: login.php'); exit; }

$file = __DIR__ . '/../assets/content/kesiswaan.html';
$msg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $content = $_POST['content'] ?? '';
    file_put_contents($file, $content);
    $msg = 'Perubahan kesiswaan berhasil disimpan.';
}
$current = file_exists($file) ? file_get_contents($file) : '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Kesiswaan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <style>
        /* Sembunyikan notifikasi warning CKEditor */
.cke_notification_warning {
    display: none !important;
}
        :root { --bg-dark: #0f172a; --bg-sidebar: #1e293b; --text-white: #f8fafc; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); }
        .main-wrapper { margin-left: 280px; padding: 40px; min-height: 100vh; }
        @media (max-width: 992px) { .main-wrapper { margin-left: 0; padding: 20px; } }
        .card-custom { background-color: var(--bg-sidebar); border: 1px solid #334155; border-radius:15px; }
        /* Fix tampilan CKEditor agar menyatu dengan tema dark */
        .cke_chrome { border-radius: 10px !important; border: none !important; }
    </style>
</head>
<body>
<div class="d-flex">
    <?php include __DIR__ . '/dashboard_sidebar.php'; ?>
    
    <div class="main-wrapper flex-grow-1">
        <div class="card card-custom p-4 shadow-lg">
            <div class="d-flex align-items-center mb-4">
                <i class="bi bi-person-badge-fill text-info fs-2 me-3"></i>
                <div>
                    <h3 class="fw-bold mb-0">Kelola Konten Kesiswaan</h3>
                    <p class="text-muted small mb-0">Tulis program siswa, OSIS, atau tata tertib di sini.</p>
                </div>
            </div>

            <?php if($msg): ?>
                <div class="alert alert-info border-0 rounded-3 shadow-sm"><?= $msg ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-4">
                    <textarea name="content" id="editor1"><?= $current ?></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-info btn-lg px-5 rounded-pill fw-bold text-white">
                        <i class="bi bi-magic me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Aktifkan CKEditor
    CKEDITOR.replace('editor1', {
        height: 400,
        removeButtons: 'About',
        // Agar admin bisa paste dari Word dengan rapi
        pasteFromWordRemoveFontStyles: true,
        pasteFromWordRemoveStyles: true,
        // Tambahkan baris ini untuk mematikan notifikasi peringatan versi:
        versionCheck: false
    });
</script><
</body>
</html>
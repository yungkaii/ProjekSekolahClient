<?php
session_start();
include '../config/koneksi.php';
if(!isset($_SESSION['status_login'])){
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Foto Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/dashboard_sidebar.php'; ?>
    <div class="main-content">
        <div class="container col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0">
                    <h3 class="fw-bold mb-0">Upload Foto Galeri</h3>
                </div>
                <div class="card-body">
                    <form action="proses.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Judul Foto</label>
                            <input type="text" name="judul" class="form-control" placeholder="Judul Kegiatan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Foto</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*" required>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" name="upload_galeri" class="btn btn-primary w-100">Upload</button>
                            <a href="galeri.php" class="btn btn-secondary w-100">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
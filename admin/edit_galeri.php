<?php
session_start();
include '../config/koneksi.php';

// Cek apakah ada ID di URL
if(!isset($_GET['id'])){
    header("Location: galeri.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM galeri WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if(!$data){
    echo "<script>alert('Data tidak ditemukan!'); window.location='galeri.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <?php include __DIR__ . '/dashboard_sidebar.php'; ?>
    <div class="main-content">
        <div class="container col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0">
                    <h3 class="fw-bold mb-0">Edit Foto Galeri</h3>
                </div>
                <div class="card-body">
                    <form action="proses.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Judul / Keterangan Foto</label>
                            <input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label><br>
                            <img src="../assets/img_galeri/<?= $data['gambar'] ?>" width="150" class="rounded mb-2 border">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ganti Foto (Opsional)</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="galeri.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="edit_galeri" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
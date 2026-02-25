<?php
session_start();
include '../config/koneksi.php';
if(!isset($_SESSION['status_login'])){ header("Location: login.php"); exit; }

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM berita WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { --bg-dark: #0f172a; --bg-sidebar: #1e293b; --text-grey: #94a3b8; --text-white: #f8fafc; }
        body { font-family: 'Open Sans', sans-serif; background-color: var(--bg-dark); color: var(--text-white); }
        .card-custom { background-color: var(--bg-sidebar); border: 1px solid #334155; border-radius: 12px; color: white; }
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; }
        .form-control:focus { background-color: #334155; color: white; border-color: #0ea5e9; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom p-4 shadow-lg">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold">Edit Berita</h3>
                    <a href="berita.php" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>

                <form action="proses.php" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Judul Berita</label>
                        <input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <img src="../assets/img_berita/<?= $data['gambar'] ?>" class="img-thumbnail mb-2" style="height: 100px;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar (Opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                        <small class="text-secondary">*Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" name="update_berita" class="btn btn-warning text-dark fw-bold w-100">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
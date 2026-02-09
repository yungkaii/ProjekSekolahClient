<?php
session_start();
include '../config/koneksi.php';
if(!isset($_SESSION['status_login'])){ header("Location: login.php"); exit; }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Ekstrakurikuler</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root { --bg-dark: #0f172a; --bg-sidebar: #1e293b; --text-grey: #94a3b8; --text-white: #f8fafc; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); }
        
        /* SIDEBAR FIX */
        .sidebar {
    background-color: var(--bg-sidebar);
    box-shadow: 2px 0 10px rgba(0,0,0,0.3);
    /* Di Laptop tingginya Full, Di HP tingginya Auto */
    min-height: 100vh; 
}

/* Tambahkan Media Query ini agar di HP tampilannya rapi */
@media (max-width: 768px) {
    .sidebar {
        min-height: auto; /* Di HP tingginya menyesuaikan isi */
        margin-bottom: 20px;
    }
    /* Sembunyikan tulisan ADMIN yang besar di HP biar hemat tempat */
    .sidebar h4 {
        display: none;
    }
}
        .nav-link { color: var(--text-grey); margin-bottom: 5px; border-radius: 8px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: rgba(255, 255, 255, 0.1); color: #fff; }
        .nav-link i { margin-right: 10px; font-size: 1.1rem; }
        
        /* CARD STYLE BARU (PERSEGI) */
        .card-custom { background-color: var(--bg-sidebar); border: 1px solid #334155; border-radius: 12px; overflow: hidden; transition: transform 0.2s; }
        .card-custom:hover { transform: translateY(-5px); border-color: #0ea5e9; }
        .card-img-top { height: 180px; object-fit: cover; width: 100%; border-bottom: 1px solid #334155; }
        
        /* MODAL STYLE */
        .modal-content { background-color: var(--bg-sidebar); color: white; border: 1px solid #475569; }
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; }
        .form-control:focus { background-color: #334155; color: white; border-color: #0ea5e9; }
        .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar col-md-2 d-none d-md-block p-3">
        <h4 class="fw-bold text-center text-white mb-4 mt-2">ADMIN</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="bi bi-grid-fill me-2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="berita.php"><i class="bi bi-newspaper me-2"></i> Kelola Berita</a></li>
            <li class="nav-item"><a class="nav-link" href="galeri.php"><i class="bi bi-images me-2"></i> Kelola Galeri</a></li>
            <li class="nav-item"><a class="nav-link active" href="ekskul.php"><i class="bi bi-stars me-2"></i> Ekstrakurikuler</a></li>
            <li class="nav-item"><a class="nav-link" href="pengaturan.php"><i class="bi bi-gear-fill me-2"></i> Pengaturan</a></li>
            <li class="nav-item mt-4"><a class="nav-link text-danger" href="logout.php"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
        </ul>
    </div>

    <div class="flex-grow-1 p-4" style="height: 100vh; overflow-y: auto;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-white">Ekstrakurikuler</h3>
                <p class="text-secondary mb-0">Kelola kegiatan pengembangan diri siswa</p>
            </div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Ekskul
            </button>
        </div>

        <div class="row g-4">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler ORDER BY id DESC");
            if(mysqli_num_rows($query) > 0){
                while($data = mysqli_fetch_array($query)){
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="card card-custom h-100 shadow-sm">
                    <img src="../assets/img_ekskul/<?= $data['gambar'] ?>" class="card-img-top" alt="<?= $data['nama_ekskul'] ?>">
                    
                    <div class="card-body p-3">
                        <h5 class="fw-bold text-white mb-3"><?= $data['nama_ekskul'] ?></h5>
                        
                        <div class="d-flex gap-2">
                            <button class="btn btn-warning btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $data['id'] ?>">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <a href="proses.php?hapus_ekskul=<?= $data['id'] ?>" class="btn btn-danger btn-sm w-100" onclick="return confirm('Hapus ekskul ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalEdit<?= $data['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><h5 class="modal-title">Edit Ekskul</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                            <form action="proses.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body text-start">
                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Ekskul</label>
                                        <input type="text" name="nama" class="form-control" value="<?= $data['nama_ekskul'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Ganti Foto (Opsional)</label>
                                        <input type="file" name="gambar" class="form-control">
                                        <small class="text-secondary">Foto saat ini: <?= $data['gambar'] ?></small>
                                    </div>
                                </div>
                                <div class="modal-footer"><button type="submit" name="update_ekskul" class="btn btn-warning">Simpan Perubahan</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
            } else {
                echo "<div class='col-12 text-center text-secondary py-5'><h4>Belum ada data ekstrakurikuler.</h4><p>Silakan klik tombol Tambah Ekskul di pojok kanan atas.</p></div>";
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Tambah Ekskul Baru</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <form action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3"><label class="form-label">Nama Ekskul</label><input type="text" name="nama" class="form-control" placeholder="Contoh: Futsal" required></div>
                    <div class="mb-3"><label class="form-label">Foto Kegiatan</label><input type="file" name="gambar" class="form-control" required></div>
                </div>
                <div class="modal-footer"><button type="submit" name="simpan_ekskul" class="btn btn-success">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
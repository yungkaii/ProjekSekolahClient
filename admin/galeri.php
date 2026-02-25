<?php
session_start();
include '../config/koneksi.php';

// Cek Login
if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Galeri</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root { --bg-dark: #0f172a; --bg-sidebar: #1e293b; --text-grey: #94a3b8; --text-white: #f8fafc; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); }
        
        /* Sidebar & Layout */
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

        /* Card Style */
        .card-custom { background-color: var(--bg-sidebar); border: 1px solid #334155; border-radius: 12px; overflow: hidden; }
        .card-img-top { height: 200px; object-fit: cover; }
        
        /* Modal Style */
        .modal-content { background-color: var(--bg-sidebar); color: white; border: 1px solid #475569; }
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; }
        .form-control:focus { background-color: #334155; color: white; border-color: #0ea5e9; box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25); }
        
        
        /* Close Button di Modal */
        .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar col-md-2 d-none d-md-block p-3">
        <h4 class="fw-bold text-center text-white mb-4 mt-2">ADMIN</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="bi bi-grid-fill me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="berita.php">
                    <i class="bi bi-newspaper me-2"></i> Kelola Berita
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="galeri.php">
                    <i class="bi bi-images me-2"></i> Kelola Galeri
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="ekskul.php">
                    <i class="bi bi-stars me-2"></i> Ekstrakurikuler
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pengaturan.php">
                    <i class="bi bi-gear-fill me-2"></i> Pengaturan
                </a>
            </li>
            <li class="nav-item mt-4">
                <a class="nav-link text-danger" href="logout.php">
                    <i class="bi bi-box-arrow-left me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Kelola Galeri</h3>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Upload Foto
            </button>
        </div>

        <div class="row g-4">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
            if(mysqli_num_rows($query) > 0){
                while($data = mysqli_fetch_array($query)){
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="card card-custom shadow-sm h-100">
                    <img src="../assets/img_galeri/<?= $data['gambar'] ?>" class="card-img-top">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-white text-center mb-3 text-truncate">
                            <?= $data['judul'] ?>
                        </h5>
                        
                        <div class="mt-auto d-flex gap-2">
                            <button class="btn btn-warning flex-grow-1 btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $data['id'] ?>">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <a href="proses.php?hapus_galeri=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus foto ini?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalEdit<?= $data['id'] ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="proses.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control" value="<?= $data['judul'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ganti Foto (Biarkan kosong jika tidak diganti)</label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="update_galeri" class="btn btn-warning fw-bold">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php 
                }
            } else {
                echo "<div class='col-12 text-center text-muted'>Belum ada data galeri.</div>";
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Foto Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Foto</label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Kegiatan Upacara" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Foto</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="simpan_galeri" class="btn btn-primary">Upload Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
include '../config/koneksi.php';

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
    <title>Kelola Berita - Admin Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root { --bg-dark: #0f172a; --bg-sidebar: #1e293b; --text-grey: #94a3b8; --text-white: #f8fafc; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); }
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
        .table-dark-custom { background-color: var(--bg-sidebar); color: var(--text-white); border-radius: 10px; overflow: hidden; }
        .table-dark-custom th { background-color: #b6bdd3; border: none; padding: 15px; font-weight: 600; }
        .table-dark-custom td { border-bottom: 1px solid #3b82f6; padding: 15px; vertical-align: middle; }
        .table-dark-custom tbody tr { background-color: #1e293b; transition: 0.3s ease; }
        .table-dark-custom tbody tr:hover { background-color: #3b82f6; transform: scale(1.01); }
        .btn-primary { background-color: #3b82f6; border: none; }
        .btn-primary:hover { background-color: #2563eb; }
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; }
        .form-control:focus { background-color: #334155; color: white; border-color: #0ea5e9; box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25); }        
        .form-control::placeholder { color: #cbd5e1; opacity: 1; }
        .form-control::-webkit-input-placeholder { color: #cbd5e1; }
        .form-control::-moz-placeholder { color: #cbd5e1; opacity: 1; }
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
                <a class="nav-link active" href="berita.php">
                    <i class="bi bi-newspaper me-2"></i> Kelola Berita
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="galeri.php">
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
        <h3 class="fw-bold mb-4">Kelola Berita</h3>

        <div class="card bg-secondary bg-opacity-10 border-0 mb-4 text-white">
            <div class="card-body">
                <h5 class="card-title mb-3"><i class="bi bi-plus-circle"></i> Tulis Berita Baru</h5>
                <form action="proses.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="judul" class="form-control bg-dark text-white border-secondary" placeholder="Judul Berita" required>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="gambar" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-12">
                            <textarea name="isi" rows="3" class="form-control bg-dark text-white border-secondary" placeholder="Isi Berita..." required></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" name="simpan_berita" class="btn btn-primary"><i class="bi bi-send"></i> Publish Berita</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive rounded-3">
            <table class="table table-dark-custom table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul Berita</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
                    while($data = mysqli_fetch_array($tampil)):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="../assets/img_berita/<?= $data['gambar'] ?>" width="60" class="rounded" style="object-fit: cover;">
                        </td>
                        <td class="fw-bold"><?= $data['judul'] ?></td>
                        <td><span class="badge bg-info text-dark"><?= date('d M Y', strtotime($data['tanggal'])) ?></span></td>
                        <td>
                            <a href="edit_berita.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <a href="proses.php?hapus_berita=<?= $data['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
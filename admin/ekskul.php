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
    <title>Kelola Ekstrakurikuler</title>
    
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
            overflow-x: hidden; /* Kunci mati scroll ke samping */
        }
        
        /* =========================================
           SUPER FIX: STRUKTUR LAYOUT UTAMA
           ========================================= */
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

        /* Responsive untuk HP */
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
        
        /* =========================================
           STYLING KOMPONEN & KARTU EKSKUL
           ========================================= */
        .nav-link { color: var(--text-grey); margin-bottom: 5px; border-radius: 8px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: rgba(255, 255, 255, 0.1); color: #fff; }
        .nav-link i { margin-right: 10px; font-size: 1.1rem; }
        
        /* Card Style (Dengan efek hover) */
        .card-custom { background-color: var(--bg-sidebar); border: 1px solid #334155; border-radius: 12px; overflow: hidden; transition: transform 0.2s; }
        .card-custom:hover { transform: translateY(-5px); border-color: #0ea5e9; }
        .card-img-top { height: 180px; object-fit: cover; width: 100%; border-bottom: 1px solid #334155; }
        
        /* Modal Style */
        .modal-content { background-color: var(--bg-sidebar); color: white; border: 1px solid #475569; }
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; width: 100%; }
        .form-control:focus { background-color: #334155; color: white; border-color: #0ea5e9; box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25); }
        .btn-close { filter: invert(1) grayscale(100%) brightness(200%); }
    </style>
</head>
<body>

<div class="admin-container">
    
    <div class="sidebar-area">
        <?php include __DIR__ . '/dashboard_sidebar.php'; ?>
    </div>

    <div class="content-area">
        <div class="container-fluid p-0">
            
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
                        <img src="../assets/img_ekskul/<?= htmlspecialchars($data['gambar']) ?>" class="card-img-top" alt="<?= htmlspecialchars($data['nama_ekskul']) ?>">
                        
                        <div class="card-body p-3">
                            <h5 class="fw-bold text-white mb-3"><?= htmlspecialchars($data['nama_ekskul']) ?></h5>
                            
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
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Ekskul</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="proses.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body text-start">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Ekskul</label>
                                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama_ekskul']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Foto (Opsional)</label>
                                            <input type="file" name="gambar" class="form-control" accept="image/*">
                                            <small class="text-secondary d-block mt-1">Foto saat ini: <?= htmlspecialchars($data['gambar']) ?></small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="update_ekskul" class="btn btn-warning">Simpan Perubahan</button>
                                    </div>
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
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Ekskul Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="proses.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Ekskul</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Futsal" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Kegiatan</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="simpan_ekskul" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Activate collapse & mark active sidebar menu
document.addEventListener('DOMContentLoaded', function(){
    const path = window.location.pathname.split('/').pop();
    const link = document.querySelector('.sidebar-area a.nav-link[href="'+path+'"]');
    if(link){
        link.classList.add('active');
        const collapseDiv = link.closest('.collapse');
        if(collapseDiv){ new bootstrap.Collapse(collapseDiv,{toggle:false}).show(); }
    }
});
</script>
</body>
</html>
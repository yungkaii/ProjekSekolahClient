<?php
session_start();
include '../config/koneksi.php';

// Cek Login
if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

// Ambil data profil (Sesuai kode Anda: tabel profil_sekolah)
$query = mysqli_query($koneksi, "SELECT * FROM profil_sekolah WHERE id=1");
$data  = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Website</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root { --bg-dark: #0f172a; --bg-sidebar: #1e293b; --text-grey: #94a3b8; --text-white: #f8fafc; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); }
        
        /* Sidebar Style */
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

        
        /* Form & Card Style */
        .card-custom { background-color: var(--bg-sidebar); border: none; border-radius: 12px; margin-bottom: 20px; }
        .section-title { color: #38bdf8; font-weight: 600; margin-bottom: 15px; border-bottom: 1px solid #334155; padding-bottom: 10px; }
        
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; }
        .form-control:focus { background-color: #334155; color: white; border-color: #0ea5e9; box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25); }
        .form-label { font-weight: 500; color: #cbd5e1; }
        
        /* File Input Adjustment */
        input[type="file"]::file-selector-button { background-color: #475569; color: white; border: none; padding: 5px 10px; margin-right: 10px; border-radius: 4px; }
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
                <a class="nav-link active" href="pengaturan.php">
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
        <h3 class="fw-bold mb-4">Pengaturan Website</h3>

        <form action="proses.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="1">
            <?php
            // ensure all expected keys exist to avoid notices
            $fields = ['alamat','telepon','email','jam_operasional','facebook','instagram','youtube','visi','misi'];
            foreach($fields as $f){ if(!isset($data[$f])) $data[$f] = ''; }
            ?>

            <div class="card card-custom p-4 shadow-sm">
                <h5 class="section-title"><i class="bi bi-info-circle"></i> 1. Identitas & Banner</h5>
                
                <div class="mb-3">
                    <label class="form-label">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" class="form-control" value="<?= $data['nama_sekolah'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Logo Navbar</label><br>
                    <?php if(!empty($data['logo']) && file_exists('../assets/img/' . $data['logo'])): ?>
                        <img src="../assets/img/<?= $data['logo'] ?>" class="mb-2 rounded border border-secondary" height="60" style="object-fit: contain;">
                    <?php else: ?>
                        <small class="text-secondary fst-italic">Belum ada logo.</small><br>
                    <?php endif; ?>
                    <input type="file" name="logo" class="form-control mt-1" accept="image/*">
                    <small class="text-secondary fst-italic">*Upload jika ingin mengganti logo</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Deskripsi Banner</label>
                    <textarea name="deskripsi_hero" class="form-control" rows="2"><?= $data['deskripsi_hero'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Banner Utama</label><br>
                    <?php if(!empty($data['gambar_hero'])): ?>
                        <img src="../assets/img_sekolah/<?= $data['gambar_hero'] ?>" class="mb-2 rounded border border-secondary" width="150" style="object-fit: cover;">
                    <?php endif; ?>
                    <input type="file" name="foto_hero" class="form-control mt-1" accept="image/*">
                    <small class="text-secondary fst-italic">*Upload jika ingin mengganti gambar</small>
                </div>
            </div>

            <div class="card card-custom p-4 shadow-sm">
                <h5 class="section-title"><i class="bi bi-person-workspace"></i> 2. Tentang Kami</h5>
                
                <div class="mb-3">
                    <label class="form-label">Isi Sambutan</label>
                    <textarea name="isi_profil" class="form-control" rows="5"><?= $data['isi_profil'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Profil (Samping)</label><br>
                    <?php if(!empty($data['gambar_profil'])): ?>
                        <img src="../assets/img_sekolah/<?= $data['gambar_profil'] ?>" class="mb-2 rounded border border-secondary" width="100" style="object-fit: cover;">
                    <?php endif; ?>
                    <input type="file" name="foto_profil" class="form-control mt-1" accept="image/*">
                </div>
            </div>

            <!-- Visi & Misi card -->
            <div class="card card-custom p-4 shadow-sm">
                <h5 class="section-title"><i class="bi bi-eye-fill"></i> Visi & Misi</h5>
                <div class="mb-3">
                    <label class="form-label">Visi</label>
                    <textarea name="visi" class="form-control" rows="2"><?= $data['visi'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Misi (pisahkan baris untuk setiap poin)</label>
                    <textarea name="misi" class="form-control" rows="4"><?= $data['misi'] ?></textarea>
                </div>
            </div>

            <div class="card card-custom p-4 shadow-sm">
                <h5 class="section-title"><i class="bi bi-telephone-fill"></i> 3. Kontak & Sosial</h5>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"><?= $data['alamat'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="<?= $data['telepon'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jam Operasional</label>
                    <input type="text" name="jam_operasional" class="form-control" value="<?= $data['jam_operasional'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Facebook URL</label>
                    <input type="url" name="facebook" class="form-control" value="<?= $data['facebook'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Instagram URL</label>
                    <input type="url" name="instagram" class="form-control" value="<?= $data['instagram'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">YouTube URL</label>
                    <input type="url" name="youtube" class="form-control" value="<?= $data['youtube'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Google Maps Embed (iframe HTML)</label>
                    <textarea name="map_embed" class="form-control" rows="3"><?= htmlspecialchars($data['map_embed'] ?? '') ?></textarea>
                    <small class="text-secondary fst-italic">Paste full &lt;iframe&gt; code dari Google Maps.</small>
                </div>
            </div>

            <div class="card card-custom p-4 shadow-sm">
                <h5 class="section-title"><i class="bi bi-check-circle"></i> 3. Poin Keunggulan</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Poin 1</label>
                        <input type="text" name="keunggulan_1" class="form-control" value="<?= $data['keunggulan_1'] ?>" placeholder="Contoh: Fasilitas Lengkap">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Poin 2</label>
                        <input type="text" name="keunggulan_2" class="form-control" value="<?= $data['keunggulan_2'] ?>" placeholder="Contoh: Guru Profesional">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Poin 3</label>
                        <input type="text" name="keunggulan_3" class="form-control" value="<?= $data['keunggulan_3'] ?>" placeholder="Contoh: Biaya Terjangkau">
                    </div>
                </div>
            </div>

            <button type="submit" name="update_profil" class="btn btn-primary w-100 py-2 fw-bold shadow">
                <i class="bi bi-save"></i> SIMPAN SEMUA PERUBAHAN
            </button>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
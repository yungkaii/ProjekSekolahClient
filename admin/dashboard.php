<?php
session_start();
include '../config/koneksi.php';

// Cek Login
if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

// === HITUNG DATA UNTUK DASHBOARD ===
// 1. Hitung Berita
$q_berita = mysqli_query($koneksi, "SELECT count(*) as total FROM berita");
$d_berita = mysqli_fetch_assoc($q_berita);

// 2. Hitung Galeri
$q_galeri = mysqli_query($koneksi, "SELECT count(*) as total FROM galeri");
$d_galeri = mysqli_fetch_assoc($q_galeri);

// 3. Ambil Nama User
$nama_user = $_SESSION['user_global'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Modern</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #0f172a;       /* Latar Belakang Utama */
            --bg-sidebar: #1e293b;    /* Latar Sidebar */
            --text-grey: #94a3b8;
            --text-white: #f8fafc;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-white);
            overflow-x: hidden;
        }

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
        
        .nav-link {
            color: var(--text-grey);
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .nav-link i { margin-right: 10px; font-size: 1.1rem; }

        /* --- GRADIENT CARDS --- */
        .card-custom {
            border: none;
            border-radius: 15px;
            color: white;
            transition: transform 0.3s;
            overflow: hidden;
            position: relative;
        }

        .card-custom:hover { transform: translateY(-5px); }

        /* Hiasan lingkaran transparan */
        .card-custom::before {
            content: '';
            position: absolute;
            top: -20px; right: -20px;
            width: 100px; height: 100px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
        }

        /* Warna Gradient */
        .bg-gradient-1 { background: linear-gradient(45deg, #4facfe, #00f2fe); } /* Biru */
        .bg-gradient-2 { background: linear-gradient(45deg, #f093fb, #f5576c); } /* Pink */
        .bg-gradient-3 { background: linear-gradient(45deg, #43e97b, #38f9d7); } /* Hijau */

        /* --- TOP NAVBAR --- */
        .top-navbar {
            background-color: var(--bg-sidebar);
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        .user-profile img {
            width: 40px; height: 40px; border-radius: 50%; border: 2px solid #4facfe;
        }
    </style>
</head>
<body>

<div class="d-flex flex-column flex-md-row">
    
    <div class="sidebar col-12 col-md-2 p-3">
        <h4 class="fw-bold text-center text-white mb-4 mt-2">ADMIN</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="dashboard.php">
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

    <div class="flex-grow-1 bg-dark">
        
        <div class="top-navbar d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold">Selamat Datang, <?= ucfirst($nama_user) ?>!</h5>
            <div class="user-profile d-flex align-items-center gap-2">
                <div class="text-end d-none d-sm-block">
                    <small class="d-block text-muted" style="font-size: 0.7rem;">Admin Role</small>
                    <span class="fw-bold"><?= ucfirst($nama_user) ?></span>
                </div>
                <img src="https://ui-avatars.com/api/?name=<?= $nama_user ?>&background=random" alt="Admin">
            </div>
        </div>

        <div class="container-fluid p-4">
            
            <div class="row g-4 mb-4">
                
                <div class="col-md-4">
                    <a href="berita.php" class="text-decoration-none">
                        <div class="card card-custom bg-gradient-1 p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-1">Total Artikel</h6>
                                    <h2 class="fw-bold m-0"><?= $d_berita['total'] ?></h2>
                                </div>
                                <i class="bi bi-newspaper display-4 opacity-50"></i>
                            </div>
                            <div class="mt-3 badge bg-white text-primary bg-opacity-75">
                                Kelola Berita <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="galeri.php" class="text-decoration-none">
                        <div class="card card-custom bg-gradient-2 p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50 mb-1">Total Foto</h6>
                                    <h2 class="fw-bold m-0"><?= $d_galeri['total'] ?></h2>
                                </div>
                                <i class="bi bi-images display-4 opacity-50"></i>
                            </div>
                            <div class="mt-3 badge bg-white text-danger bg-opacity-75">
                                Kelola Galeri <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="pengaturan.php" class="text-decoration-none">
                        <div class="card card-custom bg-gradient-3 p-4 h-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-dark mb-1">Pengaturan</h6>
                                    <h5 class="fw-bold text-dark m-0">Profil Sekolah</h5>
                                </div>
                                <i class="bi bi-gear-fill display-4 text-dark opacity-25"></i>
                            </div>
                            <div class="mt-3 badge bg-dark text-white">
                                Edit Profil <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm" style="background: var(--bg-sidebar);">
                        <div class="card-header bg-transparent border-0 text-white fw-bold py-3">
                            <i class="bi bi-bar-chart-fill text-info"></i> Statistik Pengunjung
                        </div>
                        <div class="card-body text-center py-5">
                            <h5 class="text-muted">Grafik Analitik akan muncul di sini</h5>
                            <small class="text-secondary">(Fitur dalam pengembangan)</small>
                            <div class="mt-3" style="height: 150px; background: linear-gradient(to top, rgba(79, 172, 254, 0.2), transparent); border-bottom: 2px solid #4facfe;"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100" style="background: var(--bg-sidebar);">
                        <div class="card-header bg-transparent border-0 text-white fw-bold py-3">
                            <i class="bi bi-list-check text-warning"></i> Quick Actions
                        </div>
                        <div class="card-body">
                           <div class="d-grid gap-2">
                               <a href="berita.php" class="btn btn-outline-light text-start"><i class="bi bi-plus-circle me-2"></i> Tulis Berita Baru</a>
                               <a href="galeri.php" class="btn btn-outline-light text-start"><i class="bi bi-upload me-2"></i> Upload Foto Galeri</a>
                               <a href="../index.php" target="_blank" class="btn btn-outline-info text-start"><i class="bi bi-globe me-2"></i> Lihat Website Utama</a>
                           </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> </div> </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
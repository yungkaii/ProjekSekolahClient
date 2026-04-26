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
            overflow-x: hidden; /* Kunci mati scroll ke samping di seluruh halaman */
        }

        /* =========================================
           SUPER FIX: STRUKTUR LAYOUT UTAMA
           ========================================= */
        .admin-container {
            display: flex;
            width: 100vw;
            height: 100vh; /* Kunci tinggi halaman pas seukuran layar */
            overflow: hidden;
        }

        .sidebar-area {
            width: 250px;
            flex-shrink: 0;
            background-color: var(--bg-sidebar);
            height: 100vh;
            overflow-y: auto; /* Jika menu sidebar banyak, sidebar bisa discroll */
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
            z-index: 10;
        }

        .content-area {
            flex-grow: 1;
            width: calc(100vw - 250px); /* Paksa lebar konten = layar dikurang sidebar */
            max-width: calc(100vw - 250px);
            height: 100vh;
            overflow-y: auto; /* Konten utama bisa discroll ke bawah */
            overflow-x: hidden; /* Anti jebol ke samping */
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
                padding: 0.75rem;
            }

            h3 {
                font-size: 1.25rem;
                margin-bottom: 1rem !important;
            }

            .card-body {
                padding: 1rem !important;
            }

            .card-title {
                font-size: 1rem;
            }

            .row.g-3 {
                gap: 0.75rem !important;
            }

            .row.g-3 > div {
                margin-bottom: 0.5rem;
            }

            .form-control {
                font-size: 16px; /* Prevents zoom on iOS */
            }

            .table-dark-custom th,
            .table-dark-custom td {
                padding: 10px 8px !important;
                font-size: 0.85rem;
            }

            .table-dark-custom th {
                font-size: 0.8rem;
            }

            /* Hide columns on mobile */
            .table-dark-custom th:nth-child(2),
            .table-dark-custom td:nth-child(2),
            .table-dark-custom th:nth-child(4),
            .table-dark-custom td:nth-child(4) {
                display: none;
            }

            .table-dark-custom img {
                width: 40px !important;
                height: 40px !important;
            }

            .btn-sm {
                padding: 0.4rem 0.6rem;
                font-size: 0.75rem;
            }

            .badge {
                font-size: 0.75rem;
                padding: 0.35rem 0.6rem;
            }

            .btn.btn-sm {
                margin-right: 4px;
            }

            .btn-primary {
                width: 100%;
                margin-top: 0.75rem;
            }
        }

        @media (max-width: 480px) {
            .content-area {
                padding: 0.5rem !important;
            }

            h3 {
                font-size: 1.1rem;
            }

            .card {
                margin-bottom: 0.75rem;
            }

            .table-dark-custom {
                font-size: 0.75rem;
            }

            .table-dark-custom th,
            .table-dark-custom td {
                padding: 8px 6px !important;
            }

            .btn-sm {
                padding: 0.3rem 0.5rem;
                font-size: 0.7rem;
            }
        }
        
        /* =========================================
           STYLING KOMPONEN
           ========================================= */
        .table-dark-custom { background-color: var(--bg-sidebar); color: var(--text-white); border-radius: 10px; overflow: hidden; margin-bottom: 0; }
        .table-dark-custom th { background-color: #b6bdd3; border: none; padding: 15px; font-weight: 600; color: #1e293b; }
        .table-dark-custom td { border-bottom: 1px solid #334155; padding: 15px; vertical-align: middle; }
        .table-dark-custom tbody tr { background-color: #1e293b; transition: 0.3s ease; }
        .table-dark-custom tbody tr:hover { background-color: #334155; }
        
        .btn-primary { background-color: #3b82f6; border: none; }
        .btn-primary:hover { background-color: #2563eb; }
        .form-control { background-color: #334155; border: 1px solid #475569; color: white; width: 100%; }
        .form-control:focus { background-color: #334155; color: white; border-color: #0ea5e9; box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25); }        
        .form-control::placeholder { color: #cbd5e1; }
    </style>
</head>
<body>

<div class="admin-container">
    
    <div class="sidebar-area">
        <?php include __DIR__ . '/dashboard_sidebar.php'; ?>
    </div>

    <div class="content-area">
        <div class="container-fluid p-0"> 
            
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

            <div class="table-responsive rounded-3 w-100">
                <table class="table table-dark-custom table-hover w-100 mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul Berita</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Pastikan koneksi dan query-mu benar di sini
                        $tampil = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
                        if($tampil): // Cek jika ada datanya
                            while($data = mysqli_fetch_array($tampil)):
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <img src="../assets/img_berita/<?= htmlspecialchars($data['gambar']) ?>" width="60" class="rounded" style="object-fit: cover;">
                            </td>
                            <td class="fw-bold"><?= htmlspecialchars($data['judul']) ?></td>
                            <td><span class="badge bg-info text-dark"><?= date('d M Y', strtotime($data['tanggal'])) ?></span></td>
                            <td>
                                <?php if($data['status'] == 'publish'): ?>
                                    <span class="badge bg-success">Publish</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edit_berita.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <a href="proses.php?hapus_berita=<?= $data['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php 
                            endwhile; 
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
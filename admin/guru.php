<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

// Cek apakah tabel guru ada, jika tidak buat
$cek_tabel = mysqli_query($koneksi, "SHOW TABLES LIKE 'guru'");
if(mysqli_num_rows($cek_tabel) == 0){
    $create_tabel = "CREATE TABLE guru (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nip VARCHAR(50) UNIQUE,
        nama_guru VARCHAR(150) NOT NULL,
        jabatan VARCHAR(100),
        bidang_keahlian VARCHAR(100),
        spesialisasi VARCHAR(150),
        no_telp VARCHAR(15),
        email VARCHAR(100),
        foto VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    mysqli_query($koneksi, $create_tabel);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Guru - Admin</title>
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
            overflow-x: hidden;
        }

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

        .table-dark-custom { 
            background-color: var(--bg-sidebar); 
            color: var(--text-white); 
            border-radius: 10px; 
            overflow: hidden; 
            margin-bottom: 0; 
        }

        .table-dark-custom th { 
            background-color: #b6bdd3; 
            border: none; 
            padding: 15px; 
            font-weight: 600; 
            color: #1e293b; 
        }

        .table-dark-custom td { 
            border-bottom: 1px solid #334155; 
            padding: 15px; 
            vertical-align: middle; 
        }

        .table-dark-custom tbody tr { 
            background-color: #1e293b; 
            transition: 0.3s ease; 
        }

        .table-dark-custom tbody tr:hover { 
            background-color: #334155; 
        }

        .btn-primary { 
            background-color: #3b82f6; 
            border: none; 
        }

        .btn-primary:hover { 
            background-color: #2563eb; 
        }

        h3 {
            color: var(--text-white);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

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

            .table-dark-custom th,
            .table-dark-custom td {
                padding: 10px 8px !important;
                font-size: 0.85rem;
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
        }

        @media (max-width: 480px) {
            .content-area {
                padding: 0.5rem !important;
            }

            h3 {
                font-size: 1.1rem;
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
                <h3 class="fw-bold mb-0"><i class="bi bi-person-workspace"></i> Kelola Data Guru</h3>
                <a href="tambah_guru.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Guru
                </a>
            </div>

            <div class="table-responsive rounded-3 w-100">
                <table class="table table-dark-custom table-hover w-100 mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 12%">Foto</th>
                            <th style="width: 20%">Nama Guru</th>
                            <th style="width: 15%">NIP</th>
                            <th style="width: 18%">Jabatan</th>
                            <th style="width: 15%">Bidang Keahlian</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nip ASC");
                    if($tampil && mysqli_num_rows($tampil) > 0):
                        while($data = mysqli_fetch_array($tampil)):
                            $foto_path = !empty($data['foto']) && file_exists(__DIR__ . "/../assets/img/" . $data['foto'])
                                ? "../assets/img/" . $data['foto']
                                : "https://via.placeholder.com/60x60?text=No+Image";
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($foto_path) ?>" width="60" class="rounded" style="object-fit: cover; aspect-ratio: 1;">
                        </td>
                        <td class="fw-bold"><?= htmlspecialchars($data['nama_guru']) ?></td>
                        <td><?= htmlspecialchars($data['nip'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($data['jabatan'] ?? '-') ?></td>
                        <td>
                            <?php if(!empty($data['bidang_keahlian'])): ?>
                                <span class="badge bg-info text-dark"><?= htmlspecialchars($data['bidang_keahlian']) ?></span>
                            <?php else: ?>
                                <span class="badge bg-secondary">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_guru.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <a href="proses.php?hapus_guru=<?= $data['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus guru ini?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                            Belum ada data guru. <a href="tambah_guru.php" class="link-primary">Tambah sekarang</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

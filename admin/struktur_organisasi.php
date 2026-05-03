<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

// Cek apakah tabel struktur_organisasi ada, jika tidak buat
$cek_tabel = mysqli_query($koneksi, "SHOW TABLES LIKE 'struktur_organisasi'");
if(mysqli_num_rows($cek_tabel) == 0){
    $create_tabel = "CREATE TABLE struktur_organisasi (
        id INT PRIMARY KEY AUTO_INCREMENT,
        jabatan VARCHAR(100) NOT NULL,
        nama VARCHAR(150) NOT NULL,
        foto VARCHAR(255),
        urutan INT DEFAULT 0,
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
    <title>Kelola Struktur Organisasi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root { 
            --bg-dark: #0f172a; 
            --bg-sidebar: #1e293b; 
            --text-grey: #94a3b8; 
            --text-white: #000000; 
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

        .form-control { 
            background-color: #334155; 
            border: 1px solid #475569; 
            color: white; 
        }

        .form-control:focus { 
            background-color: #334155; 
            color: white; 
            border-color: #0ea5e9; 
            box-shadow: 0 0 0 0.25rem rgba(14,165,233,0.25); 
        }

        .form-label {
            color: var(--text-white);
        }

        h3 {
            color: var(--text-white);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .modal-content {
            background-color: var(--bg-sidebar);
            border: 1px solid #334155;
        }

        .modal-header {
            border-bottom: 1px solid #334155;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
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
                <h3 class="fw-bold mb-0"><i class="bi bi-diagram-3"></i> Kelola Struktur Organisasi</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>

            <div class="table-responsive rounded-3 w-100">
                <table class="table table-dark-custom table-hover w-100 mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 12%">Foto</th>
                            <th style="width: 25%">Jabatan</th>
                            <th style="width: 25%">Nama</th>
                            <th style="width: 10%">Urutan</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM struktur_organisasi ORDER BY urutan ASC, id ASC");
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
                        <td class="fw-bold"><?= htmlspecialchars($data['jabatan']) ?></td>
                        <td><?= htmlspecialchars($data['nama']) ?></td>
                        <td><?= htmlspecialchars($data['urutan']) ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit" 
                                onclick="editData(<?= $data['id'] ?>, '<?= addslashes($data['jabatan']) ?>', '<?= addslashes($data['nama']) ?>', <?= $data['urutan'] ?>)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="proses.php?hapus_struktur=<?= $data['id'] ?>" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Yakin hapus data ini?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                            Belum ada data struktur organisasi. <a href="#" data-bs-toggle="modal" data-bs-target="#modalTambah" class="link-primary">Tambah sekarang</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Struktur Organisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="tambah_struktur_organisasi.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Struktur Organisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="edit_struktur_organisasi.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" id="editJabatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" id="editNama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" id="editUrutan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const link = document.querySelector('a[href="struktur_organisasi.php"]');
        if(link) link.classList.add('active');
    });

    function editData(id, jabatan, nama, urutan) {
        document.getElementById('editId').value = id;
        document.getElementById('editJabatan').value = jabatan;
        document.getElementById('editNama').value = nama;
        document.getElementById('editUrutan').value = urutan;
    }
</script>
</body>
</html>

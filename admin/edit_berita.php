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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-sidebar: #1e293b;
            --text-white: #000000;
        }

        * { box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-white);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .main-content {
            width: 100%;
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .card {
            background: var(--bg-sidebar) !important;
            color: var(--text-white) !important;
            border: 1px solid #334155 !important;
        }

        .form-control {
            background-color: #ffffff !important;
            border: 1px solid #ced4da !important;
            color: #111 !important;
        }

        .form-control::placeholder {
            color: #6b7280 !important;
        }

        .form-control:focus {
            background-color: #ffffff !important;
            border-color: #3b82f6 !important;
            color: #111 !important;
            box-shadow: 0 0 0 0.2rem rgba(59,130,246,0.25);
        }

        .form-label {
            color: var(--text-white);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .btn {
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #3b82f6 !important;
            border: none !important;
        }

        .btn-primary:hover {
            background-color: #2563eb !important;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #475569 !important;
            border: none !important;
        }

        .btn-secondary:hover {
            background-color: #64748b !important;
        }

        h3 {
            color: var(--text-white);
            font-weight: 700;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* =====================
           RESPONSIVE MOBILE
           ===================== */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem 0.75rem;
            }

            .card {
                border-radius: 12px !important;
            }

            .card-body {
                padding: 1.5rem 1rem !important;
            }

            .d-flex {
                flex-direction: column !important;
                gap: 0.75rem !important;
            }

            .d-flex.gap-2 {
                flex-direction: column;
                gap: 0.75rem;
            }

            .d-flex.gap-2 > * {
                width: 100% !important;
            }

            .btn {
                width: 100%;
                white-space: nowrap;
            }

            .btn-sm {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }

            .mb-3 {
                margin-bottom: 1.25rem !important;
            }

            .mb-4 {
                margin-bottom: 1.5rem !important;
            }

            .form-label {
                font-size: 0.95rem;
            }

            img.img-thumbnail {
                max-width: 150px;
                height: auto;
            }

            .badge {
                font-size: 0.85rem;
                padding: 0.4rem 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 0.75rem;
            }

            .card-body {
                padding: 1rem !important;
            }

            h3 {
                font-size: 1.25rem;
            }

            .form-control {
                font-size: 16px; /* Prevents zoom on iOS */
            }
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/dashboard_sidebar.php'; ?>
    <div class="main-content">
        <div class="container-fluid" style="max-width: 900px;">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start align-items-md-center mb-4 flex-column flex-md-row gap-3">
                        <h3 class="fw-bold mb-0">Edit Berita</h3>
                        <a href="berita.php" class="btn btn-secondary btn-sm w-100 w-md-auto"><i class="bi bi-arrow-left"></i> Kembali</a>
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
                            <small class="text-muted">*Biarkan kosong jika tidak ingin mengubah gambar.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status Saat Ini: 
                                <?php if($data['status'] == 'publish'): ?>
                                    <span class="badge bg-success">Publish</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Draft</span>
                                <?php endif; ?>
                            </label>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" name="update_berita" value="draft" class="btn btn-secondary flex-grow-1">
                                <i class="bi bi-file-earmark"></i> <span class="d-none d-sm-inline">Simpan sebagai</span> Draft
                            </button>
                            <button type="submit" name="update_berita" value="publish" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-send"></i> Publish
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
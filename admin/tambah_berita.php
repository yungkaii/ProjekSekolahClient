<?php
session_start();
include '../config/koneksi.php';
if(!isset($_SESSION['status_login'])){
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-sidebar: #1e293b;
            --text-white: #f8fafc;
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

        .card-header {
            background: var(--bg-dark) !important;
            border: none !important;
        }

        .form-control {
            background-color: #1a2332 !important;
            border: 1px solid #334155 !important;
            color: white !important;
        }

        .form-control:focus {
            background-color: #1a2332 !important;
            border-color: #3b82f6 !important;
            color: white !important;
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

        .btn-outline-secondary {
            color: #94a3b8 !important;
            border-color: #475569 !important;
        }

        .btn-outline-secondary:hover {
            background-color: #475569 !important;
        }

        h3 {
            color: var(--text-white);
            font-weight: 700;
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
            }

            .mb-3 {
                margin-bottom: 1.25rem !important;
            }

            .form-label {
                font-size: 0.95rem;
            }

            textarea.form-control {
                min-height: 120px;
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
                <div class="card-header border-0">
                    <h3 class="fw-bold mb-0">Tambah Berita Baru</h3>
                </div>
                <div class="card-body">
                    <form action="proses.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Judul Berita</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi Berita</label>
                            <textarea name="isi" class="form-control" rows="6" required></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" name="simpan_berita" value="draft" class="btn btn-secondary flex-grow-1">
                                <i class="bi bi-file-earmark"></i> <span class="d-none d-sm-inline">Simpan sebagai</span> Draft
                            </button>
                            <button type="submit" name="simpan_berita" value="publish" class="btn btn-primary flex-grow-1">
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
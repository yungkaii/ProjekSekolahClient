<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

$nama_user = $_SESSION['user_global'] ?? 'Administrator';

// Pastikan tabel pengunjung ada untuk statistik pengunjung
$createVisitors = "CREATE TABLE IF NOT EXISTS pengunjung (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(128) NULL,
    ip VARCHAR(45) NULL,
    halaman VARCHAR(255) NULL,
    tanggal DATE NULL,
    waktu TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
mysqli_query($koneksi, $createVisitors);

$totalGaleri = 0;
$resultGaleri = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM galeri");
if($resultGaleri){
    $totalGaleri = (int) mysqli_fetch_assoc($resultGaleri)['total'];
}

$visitorToday = 0;
$resultVisitorToday = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengunjung WHERE tanggal = CURDATE()");
if($resultVisitorToday){
    $visitorToday = (int) mysqli_fetch_assoc($resultVisitorToday)['total'];
}

$visitorLastWeek = 0;
$resultVisitorLastWeek = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengunjung WHERE tanggal BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND DATE_SUB(CURDATE(), INTERVAL 1 DAY)");
if($resultVisitorLastWeek){
    $visitorLastWeek = (int) mysqli_fetch_assoc($resultVisitorLastWeek)['total'];
}

$visitorGrowth = 0;
if($visitorLastWeek > 0){
    $visitorGrowth = round((($visitorToday - $visitorLastWeek) / $visitorLastWeek) * 100, 1);
}

$latestBerita = mysqli_query($koneksi, "SELECT id, judul, tanggal FROM berita ORDER BY id DESC LIMIT 4");
$latestGaleri = mysqli_query($koneksi, "SELECT id, judul, gambar, tanggal FROM galeri ORDER BY id DESC LIMIT 4");

$notifications = [];
$notifBerita = mysqli_query($koneksi, "SELECT id, judul, tanggal FROM berita ORDER BY id DESC LIMIT 3");
if($notifBerita){
    while($row = mysqli_fetch_assoc($notifBerita)){
        $notifications[] = [
            'type' => 'Berita',
            'title' => $row['judul'],
            'time' => date('Y-m-d H:i:s', strtotime($row['tanggal'])),
            'display' => date('d M Y', strtotime($row['tanggal'])),
            'link' => 'berita.php'
        ];
    }
}
$notifGaleri = mysqli_query($koneksi, "SELECT id, judul, tanggal FROM galeri ORDER BY id DESC LIMIT 3");
if($notifGaleri){
    while($row = mysqli_fetch_assoc($notifGaleri)){
        $notifications[] = [
            'type' => 'Galeri',
            'title' => $row['judul'],
            'time' => $row['tanggal'],
            'display' => date('d M Y H:i', strtotime($row['tanggal'])),
            'link' => 'galeri.php'
        ];
    }
}

usort($notifications, function($a, $b){
    return strtotime($b['time']) <=> strtotime($a['time']);
});
$notifications = array_slice($notifications, 0, 5);
$notificationCount = count($notifications);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Bina Karya Kreatif</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-sidebar: #053b29;
            --bg-sidebar-active: #085138;
            --primary-green: #066943;
            --light-green: #e9f5f0;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-main);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar-wrapper {
            width: 260px;
            background: var(--bg-sidebar);
            min-height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 25px 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand .logo-icon {
            background: #10b981;
            padding: 8px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-nav {
            padding: 0 15px;
            flex-grow: 1;
        }

        .nav-link {
            color: #cbd5e1;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--bg-sidebar-active);
            color: white;
        }

        .sidebar-profile {
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.05);
            background: var(--bg-sidebar);
        }

        .btn-logout {
            background: #10b981;
            color: white;
            font-weight: 500;
            border: none;
        }
        .btn-logout:hover {
            background: #059669;
            color: white;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        .search-bar {
            background: #f1f5f9;
            border-radius: 50px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            width: 300px;
        }
        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            margin-left: 10px;
            font-size: 14px;
        }

        .icon-btn {
            background: transparent;
            border: none;
            font-size: 20px;
            color: var(--text-muted);
            cursor: pointer;
        }

        /* --- CARDS --- */
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            height: 100%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            position: relative;
        }
        
        .stat-card.green-card {
            background: var(--primary-green);
            color: white;
        }

        .badge-soft-green {
            background: #dcfce7;
            color: #16a34a;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* --- TABLE --- */
        .table-custom {
            width: 100%;
            table-layout: fixed;
        }
        .table-custom th {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 600;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 15px;
        }
        .table-custom td {
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            padding: 15px 0;
            font-size: 14px;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .table-custom td .fw-bold {
            display: block;
            max-width: 100%;
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dot-status {
            height: 8px;
            width: 8px;
            background-color: #10b981;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }

        /* --- GALLERY GRID --- */
        .gallery-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .gallery-item {
            aspect-ratio: 1;
            border-radius: 12px;
            object-fit: cover;
            width: 100%;
        }
        .add-photo-box {
            aspect-ratio: 1;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #10b981;
            cursor: pointer;
            background: #f8fafc;
            transition: 0.2s;
        }
        .add-photo-box:hover {
            background: #f1f5f9;
            border-color: #10b981;
        }

        .tips-box {
            background: #eef7f3;
            border: 1px solid #d1eadd;
            border-radius: 12px;
            padding: 15px;
            margin-top: 20px;
            display: flex;
            gap: 15px;
        }
        
        /* Bar chart dummy */
        .mini-bar-chart {
            display: flex;
            align-items: flex-end;
            gap: 4px;
            height: 30px;
            margin-top: 10px;
        }
        .mini-bar {
            width: 12px;
            background: #10b981;
            border-radius: 2px 2px 0 0;
        }
    </style>
</head>

<body>

<?php include 'dashboard_sidebar.php'; ?>

<div class="main-content">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--primary-green);">Selamat Datang, <?= htmlspecialchars($nama_user) ?>!</h3>
            <p class="text-muted fs-6 mb-0">Pantau aktivitas sekolah hari ini.</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="search-bar">
                <i class="bi bi-search text-muted"></i>
            </div>
            <div class="dropdown">
                <button class="btn icon-btn dropdown-toggle position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell"></i>
                    <?php if($notificationCount > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem; padding: .25rem .4rem;">
                            <?= $notificationCount ?>
                        </span>
                    <?php endif; ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="min-width: 300px;">
                    <li><h6 class="dropdown-header">Notifikasi Terbaru</h6></li>
                    <?php if($notificationCount === 0): ?>
                        <li><span class="dropdown-item-text text-muted">Belum ada notifikasi baru.</span></li>
                    <?php else: ?>
                        <?php foreach($notifications as $note): ?>
                            <li>
                                <a class="dropdown-item" href="<?= $note['link'] ?>">
                                    <strong><?= htmlspecialchars($note['type']) ?></strong> - <?= htmlspecialchars($note['title']) ?><br>
                                    <small class="text-muted"><?= $note['display'] ?></small>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card green-card d-flex flex-column justify-content-between">
                <div>
                    <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 32px; height: 32px;">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <h5 class="fw-bold">Tambah Berita</h5>
                    <p class="text-white-50" style="font-size: 13px;">Publikasikan artikel terbaru untuk website sekolah.</p>
                </div>
                <a href="berita.php" class="btn bg-white text-success rounded-pill fw-bold" style="width: max-content; font-size: 13px;">
                    Buat Draft <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card d-flex flex-column justify-content-between">
                <div>
                    <div class="text-success rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 32px; height: 32px; background: var(--light-green);">
                        <i class="bi bi-camera-fill"></i>
                    </div>
                    <h5 class="fw-bold">Upload Foto Galeri</h5>
                    <p class="text-muted" style="font-size: 13px;">Bagikan momen terbaik kegiatan sekolah ke galeri.</p>
                </div>
                <a href="tambah_galeri.php" class="btn rounded-pill fw-bold" style="width: max-content; font-size: 13px; background: var(--light-green); color: var(--primary-green);">
                    Upload Galeri <i class="bi bi-cloud-arrow-up"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card text-center d-flex flex-column align-items-start justify-content-center">
                <p class="text-muted mb-1" style="font-size: 14px;">Total Galeri</p>
                <div class="d-flex align-items-center gap-3">
                    <h1 class="fw-bold mb-0" style="color: var(--primary-green); font-size: 3rem;"><?= number_format($totalGaleri) ?></h1>
                    <span class="badge-soft-green">+1 Minggu Ini</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card">
                <p class="text-muted mb-1" style="font-size: 14px;">Statistik Pengunjung</p>
                <h2 class="fw-bold text-dark mb-0"><?= number_format($visitorToday) ?></h2>
                <p class="text-muted mb-0" style="font-size: 13px;">Kunjungan hari ini</p>
                <div class="d-flex align-items-end justify-content-between mt-2">
                    <div class="mini-bar-chart">
                        <div class="mini-bar" style="height: 10px; background: #86efac;"></div>
                        <div class="mini-bar" style="height: 15px; background: #4ade80;"></div>
                        <div class="mini-bar" style="height: 12px; background: #86efac;"></div>
                        <div class="mini-bar" style="height: 20px; background: #22c55e;"></div>
                        <div class="mini-bar" style="height: 18px; background: #16a34a;"></div>
                        <div class="mini-bar" style="height: 25px; background: #15803d;"></div>
                    </div>
                </div>
                <div class="mt-2" style="font-size: 11px; color: #16a34a; font-weight: 600;">
                    <i class="bi bi-graph-up-arrow"></i> <?= $visitorGrowth >= 0 ? '+' . $visitorGrowth : $visitorGrowth ?>% dibanding minggu lalu
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-journal-text text-success"></i> Berita Terakhir
                </h5>
                <a href="berita.php" class="text-success text-decoration-none fw-bold" style="font-size: 14px;">Lihat Semua</a>
            </div>

            <div class="bg-white rounded-4 p-4 shadow-sm">
                <table class="table table-borderless table-custom mb-0">
                    <thead>
                        <tr>
                            <th>Judul Artikel</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($latestBerita && mysqli_num_rows($latestBerita) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($latestBerita)): ?>
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($row['judul']) ?></div>
                                        <div class="text-muted" style="font-size: 12px;">Oleh: Admin Utama</div>
                                    </td>
                                    <td><span class="badge-soft-green" style="background: #a7f3d0; color: #065f46;">BERITA</span></td>
                                    <td class="text-muted"><?= date('d M', strtotime($row['tanggal'])) ?><br><?= date('Y', strtotime($row['tanggal'])) ?></td>
                                    <td class="fw-bold" style="color: #10b981; font-size: 13px;">
                                        <span class="dot-status"></span>Published
                                    </td>
                                    <td><a href="edit_berita.php?id=<?= $row['id'] ?>" class="text-muted"><i class="bi bi-pencil"></i></a></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-muted text-center">Belum ada berita terbaru.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-images text-success"></i> Galeri Terbaru
                </h5>
                <a href="galeri.php" class="text-success text-decoration-none fw-bold" style="font-size: 14px;">Lihat Galeri</a>
            </div>

            <div class="gallery-grid">
                <?php if($latestGaleri && mysqli_num_rows($latestGaleri) > 0): ?>
                    <?php while($item = mysqli_fetch_assoc($latestGaleri)): ?>
                        <?php
                            $imgLocal = __DIR__ . '/../assets/img_galeri/' . $item['gambar'];
                            $imgSrc = file_exists($imgLocal) ? '../assets/img_galeri/' . $item['gambar'] : 'https://via.placeholder.com/150/cccccc/333?text=No+Image';
                        ?>
                        <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($item['judul']) ?>" class="gallery-item shadow-sm">
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="gallery-item d-flex align-items-center justify-content-center text-muted" style="background:#f8fafc;">Belum ada foto di galeri.</div>
                <?php endif; ?>
                <div class="add-photo-box" onclick="window.location.href='tambah_galeri.php'">
                    <i class="bi bi-camera mb-1 fs-4"></i>
                    <span style="font-size: 12px; font-weight: 600;">Tambah Foto</span>
                </div>
            </div>

            <div class="tips-box">
                <i class="bi bi-info-circle text-success fs-5 mt-1"></i>
                <div>
                    <h6 class="fw-bold text-success mb-1" style="font-size: 14px;">Tips Kelola Galeri</h6>
                    <p class="text-muted mb-0" style="font-size: 12px; line-height: 1.5;">Gunakan format .jpg atau .png dengan ukuran maksimal 2MB untuk menjaga kecepatan website sekolah.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
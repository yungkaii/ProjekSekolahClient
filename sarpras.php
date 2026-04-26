<?php
include 'config/koneksi.php';
include 'includes/header.php';
include 'includes/navbar.php';

$content = 'Konten belum tersedia.';
$file = __DIR__ . '/assets/content/sarpras.html';
if(file_exists($file)){
    $content = file_get_contents($file);
}

// Ambil warna banner
$banner_color = '#4f46e5'; 
$color_query = mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE nama_pengaturan = 'banner_color_sarpras' LIMIT 1");
if($color_query && mysqli_num_rows($color_query) > 0){
    $row = mysqli_fetch_assoc($color_query);
    $banner_color = $row['nilai'];
}

// Ambil foto banner
$banner_foto = '';
$foto_query = mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE nama_pengaturan = 'banner_foto_sarpras' LIMIT 1");
if($foto_query && mysqli_num_rows($foto_query) > 0){
    $row = mysqli_fetch_assoc($foto_query);
    $banner_foto = $row['nilai'];
    if(!file_exists(__DIR__ . '/assets/img/' . $banner_foto)){
        $banner_foto = '';
    }
}
?>

<style>
    :root {
        --primary-sarpras: <?= htmlspecialchars($banner_color) ?>; 
        --secondary-sarpras: #3b82f6; 
        --dark-sarpras: #0f172a;
        --text-sarpras: #334155;
        --bg-light: #f8fafc;
    }

    body { background-color: var(--bg-light); overflow-x: hidden; }

    /* --- ANIMASI KEYFRAMES --- */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* --- HERO SECTION --- */
    .hero-sarpras {
        position: relative;
        padding: 160px 0 100px;
        background: 
            linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(30,27,75,0.7) 100%)
            <?php if($banner_foto): ?>, url('assets/img/<?= htmlspecialchars($banner_foto) ?>') <?php endif; ?>;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        text-align: center;
        color: #ffffff;
        animation: fadeIn 1s ease-in-out; /* Animasi Background */
    }

    .hero-sarpras .badge {
        animation: fadeInDown 0.8s ease-out both;
    }

    .hero-sarpras h1 { 
        font-size: 3.5rem; 
        font-weight: 800; 
        color: #fff !important; 
        text-shadow: 0 4px 15px rgba(0,0,0,0.5);
        animation: fadeInDown 1s ease-out 0.2s both; /* Delay sedikit agar bergantian */
    }

    .hero-sarpras p {
        animation: fadeInUp 1s ease-out 0.4s both;
    }

    /* --- MAIN CONTENT WRAPPER --- */
    .sarpras-container { 
        position: relative; 
        margin-top: -60px; 
        padding-bottom: 100px; 
        z-index: 10; 
    }

    .card-sarpras {
        border: none;
        border-radius: 24px;
        background: #ffffff;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        animation: fadeInUp 1.2s cubic-bezier(0.165, 0.84, 0.44, 1) 0.6s both; /* Animasi Card muncul dari bawah */
    }

    .card-sarpras::before {
        content: '';
        display: block;
        height: 6px;
        width: 100%;
        background: linear-gradient(90deg, var(--primary-sarpras), var(--secondary-sarpras));
    }

    .sarpras-content { padding: 50px 60px; color: var(--text-sarpras); font-size: 1.15rem; line-height: 1.9; }

    /* JURUS BIAR TABEL & GAMBAR KE TENGAH */
    .sarpras-content img {
        display: block !important;
        margin: 30px auto !important; 
        max-width: 100%;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .sarpras-content img:hover { transform: scale(1.02); }

    .sarpras-content table {
        margin-left: auto !important;
        margin-right: auto !important;
        margin-top: 20px !important;
        margin-bottom: 20px !important;
        border-collapse: collapse;
        width: auto !important;
        max-width: 100%;
    }

    .sarpras-content p[style*="text-align:center"], 
    .sarpras-content div[style*="text-align:center"] {
        text-align: center !important;
    }

    @media (max-width: 768px) {
        .sarpras-content { padding: 30px 20px; }
        .hero-sarpras h1 { font-size: 2.2rem; }
    }
</style>

<div class="hero-sarpras">
    <div class="container">
        <span class="badge bg-white text-dark mb-3 px-3 py-2 rounded-pill shadow-sm" style="font-weight: 600;">
            <i class="bi bi-building-fill text-primary me-1"></i> Fasilitas
        </span>
        <h1>Sarana & Prasarana</h1>
        <p>Mendukung proses belajar mengajar dengan fasilitas modern dan lengkap.</p>
    </div>
</div>

<div class="sarpras-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card-sarpras shadow">
                    <div class="sarpras-content">
                        <?php if(empty(trim(strip_tags($content, '<img><iframe><table>')))): ?>
                            <div class="text-center py-5">
                                <i class="bi bi-buildings text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                                <h3 class="fw-bold text-muted mb-2">Fasilitas Belum Ditambahkan</h3>
                            </div>
                        <?php else: ?>
                            <div class="main-output">
                                <?= $content ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
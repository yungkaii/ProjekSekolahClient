<?php
include 'config/koneksi.php';
include 'includes/header.php';
include 'includes/navbar.php';

$content = '';
$file = __DIR__ . '/assets/content/kurikulum.html';
if(file_exists($file)){
    $content = file_get_contents($file);
}
?>

<style>
    /* =========================================
       SUPER PREMIUM KURIKULUM STYLES
       ========================================= */
    :root {
        --primary-color: #10b981; /* Emerald Green */
        --dark-bg: #0f172a;
        --light-bg: #f8fafc;
        --text-main: #334155;
    }

    body {
        background-color: var(--light-bg) !important;
        /* Font-family dihapus agar mengikuti font bawaan header.php */
    }

    /* 1. Hero Section dengan Parallax & Overlay Elegan */
    .hero-section {
        background: linear-gradient(to bottom, rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.95)), 
                    url('https://images.unsplash.com/photo-1510070112810-d4e9a46d9e91?q=80&w=2070'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Efek Parallax */
        padding: 180px 0 140px 0; 
        color: #ffffff;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        animation: fadeInDown 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .hero-section h1 {
        font-weight: 800;
        letter-spacing: -1px;
        color: #ffffff;
        text-shadow: 0 10px 20px rgba(0,0,0,0.5);
        margin-bottom: 20px;
    }

    .hero-section .lead {
        color: #cbd5e1;
        max-width: 750px;
        margin: 0 auto;
        font-size: 1.25rem;
        line-height: 1.8;
    }

    /* Breadcrumb Stylish */
    .breadcrumb-custom {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        display: inline-flex;
        padding: 8px 20px;
        border-radius: 50px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .breadcrumb-custom .breadcrumb-item, 
    .breadcrumb-custom .breadcrumb-item a {
        color: #f1f5f9;
        text-decoration: none;
        font-size: 0.85rem;
        letter-spacing: 1px;
        font-weight: 500;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.5) !important;
    }

    /* 2. Content Card (Melayang & Glassmorphism) */
    .content-wrapper {
        margin-top: -80px;
        position: relative;
        z-index: 10;
        padding-bottom: 100px;
    }

    .content-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0,0,0,0.02);
        padding: 70px 80px;
        animation: fadeInUp 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s both;
    }

    /* 3. Merapikan Output CKEditor ala Editorial Majalah */
    .curriculum-body {
        line-height: 2;
        color: var(--text-main);
        font-size: 1.15rem;
    }

    .curriculum-body h1, .curriculum-body h2, .curriculum-body h3 {
        color: var(--dark-bg);
        font-weight: 700;
        margin-top: 2em;
        margin-bottom: 1em;
        line-height: 1.4;
    }

    .curriculum-body h2 {
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }

    .curriculum-body h2::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 4px;
        background-color: var(--primary-color);
        border-radius: 2px;
    }

    .curriculum-body p { margin-bottom: 1.5em; }

    .curriculum-body ul, .curriculum-body ol {
        margin-bottom: 2em;
        padding-left: 1.5em;
        background: #f8fafc;
        padding: 25px 25px 25px 45px;
        border-radius: 15px;
        border-left: 4px solid var(--primary-color);
    }

    .curriculum-body li { margin-bottom: 10px; }

    .curriculum-body img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 16px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        margin: 30px 0;
        transition: transform 0.3s ease;
    }

    .curriculum-body img:hover { transform: scale(1.01); }

    /* 4. Call to Action (Hubungi Kami) */
    .cta-box {
        display: inline-flex;
        align-items: center;
        gap: 20px;
        background: white;
        padding: 15px 20px 15px 30px;
        border-radius: 50px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        animation: fadeInUp 1s ease 0.6s both;
    }

    .cta-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(16, 185, 129, 0.15);
        border-color: #10b981;
    }

    /* Animations */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive untuk HP */
    @media (max-width: 768px) {
        .hero-section { padding: 140px 0 100px 0; }
        .hero-section h1 { font-size: 2.5rem; }
        .content-card { padding: 40px 30px; border-radius: 20px; }
        .curriculum-body { font-size: 1.05rem; }
        .cta-box { flex-direction: column; padding: 20px; gap: 15px; text-align: center; border-radius: 20px;}
    }
</style>

<section class="hero-section">
    <div class="container hero-content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active" style="color: #10b981 !important;">Kurikulum</li>
            </ol>
        </nav>
        <h1 class="display-3">Struktur Kurikulum</h1>
        <p class="lead">Komitmen kami dalam menyajikan standar pendidikan berkualitas tinggi, inovatif, dan adaptif untuk membentuk masa depan siswa yang cemerlang.</p>
    </div>
</section>

<div class="content-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10"> <div class="content-card">
                    <article class="curriculum-body">
                        <?php if(empty(trim(strip_tags($content)))): ?>
                            <div class="text-center py-5">
                                <img src="https://illustrations.popsy.co/gray/reading-a-book.svg" style="width: 250px; box-shadow: none;" alt="Empty Content">
                                <h4 class="mt-4 fw-bold text-dark">Belum Ada Informasi</h4>
                                <p class="text-muted">Konten kurikulum saat ini belum diisi atau sedang dalam pembaruan oleh pihak sekolah.</p>
                            </div>
                        <?php else: ?>
                            <?= $content ?>
                        <?php endif; ?>
                    </article>
                </div>

                <div class="mt-5 text-center">
                    <div class="cta-box">
                        <div class="text-start">
                            <span class="d-block fw-bold text-dark">Punya Pertanyaan?</span>
                            <span class="text-muted small">Hubungi kami untuk info akademik lebih lanjut.</span>
                        </div>
                        <a href="kontak.php" class="btn btn-success btn-lg rounded-pill px-4 fw-semibold shadow-sm">
                            <i class="bi bi-chat-dots me-2"></i>Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
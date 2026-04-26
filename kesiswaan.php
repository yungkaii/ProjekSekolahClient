<?php
include 'config/koneksi.php';
include 'includes/header.php';
include 'includes/navbar.php';

$file = __DIR__ . '/assets/content/kesiswaan.html';
$content = file_exists($file) ? file_get_contents($file) : '<h3 class="text-center">Informasi Kesiswaan</h3><p class="text-center text-muted">Sedang dalam perbaikan.</p>';
?>

<style>
    /* =========================================
       SUPER PREMIUM KESISWAAN STYLES
       ========================================= */
    :root {
        --primary-color: #059669;
        --secondary-color: #10b981;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --bg-light: #f8fafc;
    }

    body {
        background-color: var(--bg-light);
    }

    /* --- Hero Section & Waves --- */
    .hero-kesiswaan {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        padding: 100px 0 60px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero-kesiswaan::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('data:image/svg+xml,%3Csvg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ffffff" fill-opacity="0.05" fill-rule="evenodd"%3E%3Ccircle cx="3" cy="3" r="3"/%3E%3Ccircle cx="13" cy="13" r="3"/%3E%3C/g%3E%3C/svg%3E');
    }

    .hero-content {
        position: relative;
        z-index: 2;
        animation: slideDown 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    .wave-container {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
    }

    .wave-container svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 80px;
    }

    /* --- Content Card --- */
    .content-wrapper {
        margin-top: -40px;
        position: relative;
        z-index: 10;
        padding-bottom: 80px;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 24px;
        padding: 60px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08), 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid rgba(255,255,255,0.2);
        animation: slideUp 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s both;
    }

    /* --- Styling Khusus Output CKEditor (Biar Rapi!) --- */
    .ckeditor-content {
        color: var(--text-dark);
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .ckeditor-content h1, .ckeditor-content h2, .ckeditor-content h3 {
        color: var(--primary-color);
        font-weight: 700;
        margin-top: 1.5em;
        margin-bottom: 0.8em;
    }

    .ckeditor-content p {
        margin-bottom: 1.2em;
        color: #475569;
    }

    .ckeditor-content ul, .ckeditor-content ol {
        margin-bottom: 1.5em;
        padding-left: 1.5em;
    }

    .ckeditor-content li {
        margin-bottom: 0.5em;
        color: #475569;
    }

    .ckeditor-content img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        margin: 20px 0;
        display: block;
    }

    .ckeditor-content blockquote {
        border-left: 5px solid var(--secondary-color);
        background: #f1f5f9;
        padding: 20px;
        border-radius: 0 12px 12px 0;
        font-style: italic;
        margin: 20px 0;
    }

    /* --- Back to Top Button --- */
    #backToTop {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: var(--primary-color);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 10px 20px rgba(5, 150, 105, 0.3);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 999;
    }

    #backToTop.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    #backToTop:hover {
        background: var(--secondary-color);
        transform: translateY(-5px);
    }

    /* --- Animations --- */
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- Responsive Mobile --- */
    @media (max-width: 768px) {
        .glass-card { padding: 30px; border-radius: 20px; }
        .hero-kesiswaan { padding: 80px 0 50px; }
        .ckeditor-content { font-size: 1rem; }
    }
</style>

<section class="hero-kesiswaan">
    <div class="container hero-content">
        <span class="badge bg-white text-success mb-3 px-3 py-2 rounded-pill shadow-sm">
            <i class="bi bi-star-fill me-1"></i> BINA KARYA KREATIF
        </span>
        <h1 class="fw-bold display-4 mb-3">Kesiswaan</h1>
        <p class="lead fw-normal mx-auto" style="max-width: 600px; opacity: 0.9;">
            Membentuk Karakter Unggul, Kreatif, dan Berakhlak Mulia untuk Masa Depan yang Cemerlang.
        </p>
    </div>
    
    <div class="wave-container">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.3,197.8,105.14Z" fill="#f8fafc"></path>
        </svg>
    </div>
</section>

<section class="content-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="glass-card">
                    <div class="ckeditor-content">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<a href="#" id="backToTop" title="Kembali ke Atas">
    <i class="bi bi-arrow-up fs-4"></i>
</a>

<script>
    // Script untuk memunculkan tombol Back to Top saat di-scroll
    window.addEventListener('scroll', function() {
        var backToTopBtn = document.getElementById('backToTop');
        if (window.scrollY > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });

    // Smooth scroll ke atas
    document.getElementById('backToTop').addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

<?php include 'includes/footer.php'; ?>
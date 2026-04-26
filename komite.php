<?php
include 'config/koneksi.php';
include 'includes/header.php';
include 'includes/navbar.php';

$content = 'Konten belum tersedia.';
// Pastikan path file html-nya benar
$file = __DIR__ . '/assets/content/komite.html';
if(file_exists($file)){
    $content = file_get_contents($file);
}
?>

<style>
    :root {
        --primary-komite: #10b981; /* Emerald Green */
        --secondary-komite: #047857;
        --dark-komite: #0f172a;
        --text-komite: #334155;
        --bg-light: #f8fafc;
    }

    body {
        background-color: var(--bg-light);
    }

    /* --- HERO SECTION KOMITE --- */
    .hero-komite {
        position: relative;
        padding: 160px 0 100px;
        background: linear-gradient(135deg, var(--dark-komite) 0%, #1e293b 100%);
        overflow: hidden;
        text-align: center;
        color: #ffffff;
    }

    /* Animasi Bola Cahaya di Background */
    .hero-komite::before, .hero-komite::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.4;
        animation: floatShape 8s ease-in-out infinite alternate;
    }

    .hero-komite::before {
        width: 300px;
        height: 300px;
        background: var(--primary-komite);
        top: -50px;
        left: -100px;
    }

    .hero-komite::after {
        width: 250px;
        height: 250px;
        background: #3b82f6; /* Biru tipis buat gradasi */
        bottom: -50px;
        right: -50px;
        animation-delay: 2s;
    }

    @keyframes floatShape {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(30px, 40px) scale(1.1); }
    }

    .hero-komite-content {
        position: relative;
        z-index: 2;
        animation: slideDownFade 1s ease-out;
    }

    @keyframes slideDownFade {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hero-komite h1 {
        font-size: 3.5rem;
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 15px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.3);
        color: #ffffff !important; /* INI PENYELAMATNYA BIAR GA HITAM LAGI! */
    }

    .hero-komite p {
        font-size: 1.1rem;
        color: #cbd5e1 !important; /* Dipertegas juga biar amannn */
        max-width: 600px;
        margin: 0 auto;
    }

    /* --- MAIN CONTENT WRAPPER --- */
    .komite-container {
        position: relative;
        margin-top: -60px; /* Narik konten ke atas numpuk di hero */
        padding-bottom: 100px;
        z-index: 10;
    }

    /* --- GLASSMORPHISM CARD --- */
    .card-komite {
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 24px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(16px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: slideUpFade 1.2s ease-out;
    }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card-komite:hover {
        box-shadow: 0 30px 60px -10px rgba(0, 0, 0, 0.2);
    }

    /* Hiasan Garis Atas Card */
    .card-komite::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--primary-komite), #3b82f6);
    }

    .komite-content {
        padding: 60px;
        color: var(--text-komite);
        font-size: 1.1rem;
        line-height: 1.8;
    }

    /* --- STYLING KHUSUS OUTPUT CKEDITOR --- */
    .komite-content h1, .komite-content h2, .komite-content h3 {
        color: var(--dark-komite);
        font-weight: 700;
        margin-top: 1.5em;
        margin-bottom: 0.8em;
    }

    /* Memastikan gambar bagan rapi dan keren */
    .komite-content img {
        display: block;
        margin: 30px auto;
        max-width: 100%;
        height: auto;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.15); /* Shadow hijau tipis */
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .komite-content img:hover {
        transform: scale(1.02) translateY(-5px);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.25);
    }

    /* Jika admin memasukkan Tabel Struktur */
    .komite-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 30px 0;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .komite-content th, .komite-content td {
        padding: 15px 20px;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
    }

    .komite-content th {
        background-color: var(--primary-komite);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }

    .komite-content tr:hover td {
        background-color: #f1f5f9;
    }

    .komite-content ul, .komite-content ol {
        margin-bottom: 1.5em;
        padding-left: 20px;
    }

    .komite-content li {
        margin-bottom: 10px;
    }

    /* --- RESPONSIVE DESIGN --- */
    @media (max-width: 992px) {
        .komite-content { padding: 40px; }
        .hero-komite h1 { font-size: 3rem; }
    }

    @media (max-width: 768px) {
        .hero-komite { padding: 130px 20px 80px; }
        .hero-komite h1 { font-size: 2.2rem; }
        .hero-komite p { font-size: 1rem; }
        .komite-container { margin-top: -40px; padding-bottom: 60px;}
        .komite-content { padding: 30px 20px; font-size: 1rem; }
        .card-komite { border-radius: 20px; }
    }
</style>

<div class="hero-komite">
    <div class="container hero-komite-content">
        <span class="badge bg-white text-dark mb-3 px-3 py-2 rounded-pill shadow-sm" style="font-weight: 600;">
            <i class="bi bi-diagram-3-fill text-success me-1"></i> Organisasi
        </span>
        <h1>Struktur Komite</h1>
        <p>Susunan kepengurusan dan pilar penggerak sekolah demi mewujudkan pendidikan yang berkualitas dan berintegritas.</p>
    </div>
</div>

<div class="komite-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card card-komite">
                    <div class="komite-content">
                        <?php if(empty(trim(strip_tags($content, '<img><table>')))): ?>
                            <div class="text-center py-5">
                                <div class="mb-4" style="animation: floatShape 3s infinite alternate ease-in-out;">
                                    <i class="bi bi-diagram-2 text-muted" style="font-size: 5rem; opacity: 0.5;"></i>
                                </div>
                                <h3 class="fw-bold text-muted mb-2">Belum Ada Struktur</h3>
                                <p class="text-muted">Informasi atau bagan struktur komite sedang dalam proses pembaruan oleh pihak sekolah.</p>
                            </div>
                        <?php else: ?>
                            <?= $content ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
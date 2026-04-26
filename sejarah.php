<?php
include 'config/koneksi.php';
include 'includes/header.php';
include 'includes/navbar.php';

$content = 'Konten belum tersedia.';
$file = __DIR__ . '/assets/content/sejarah.html';
if (file_exists($file)) {
    $content = file_get_contents($file);
}

// Ambil warna banner dari database
$banner_color = '#198754';
$color_query = mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE nama_pengaturan = 'banner_color_sejarah' LIMIT 1");
if ($color_query && mysqli_num_rows($color_query) > 0) {
    $row = mysqli_fetch_assoc($color_query);
    $banner_color = $row['nilai'];
}

// Ambil foto banner dari database
$banner_foto = '';
$foto_query = mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE nama_pengaturan = 'banner_foto_sejarah' LIMIT 1");
if ($foto_query && mysqli_num_rows($foto_query) > 0) {
    $row = mysqli_fetch_assoc($foto_query);
    $banner_foto = $row['nilai'];

    if (!file_exists(__DIR__ . '/assets/img/' . $banner_foto)) {
        $banner_foto = '';
    }
}

// Default background image
$bg_image = 'assets/img/sekolah.jpg';
if ($banner_foto) {
    $bg_image = 'assets/img/' . htmlspecialchars($banner_foto);
}
?>

<style>
:root{
    --primary: <?= htmlspecialchars($banner_color) ?>;
    --dark: #0f172a;
    --text: #334155;
    --muted: #64748b;
    --bg: #f8fafc;
    --white: #ffffff;
    --shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
    --radius-xl: 24px;
}

body{
    background:
        radial-gradient(circle at top left, rgba(25,135,84,0.08), transparent 25%),
        radial-gradient(circle at top right, rgba(25,135,84,0.06), transparent 20%),
        linear-gradient(180deg, #f8fafc 0%, #eef3f8 100%);
    color: var(--text);
}

/* --- ANIMASI --- */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes pulseGlow {
    0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
}

/* HERO */
.hero-sejarah{
    position: relative;
    min-height: 450px;
    background:
        linear-gradient(135deg, rgba(15,23,42,0.85), rgba(15,23,42,0.5)),
        url('<?= $bg_image ?>');
    background-size: cover;
    background-position: center;
    background-attachment: fixed; /* Efek Parallax Tipis */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    overflow: hidden;
}

.hero-sejarah::before{
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.15), transparent 25%),
        radial-gradient(circle at 80% 30%, rgba(255,255,255,0.05), transparent 20%);
}

.hero-inner{
    position: relative;
    z-index: 2;
    max-width: 900px;
    padding: 30px 20px;
    animation: fadeInUp 1s ease-out;
}

.hero-badge{
    display: inline-block;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff;
    padding: 8px 22px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 20px;
    backdrop-filter: blur(10px);
    animation: pulseGlow 2s infinite;
}

.hero-sejarah h1{
    font-size: 56px;
    font-weight: 800;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
    line-height: 1.2;
    text-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

.hero-sejarah p{
    font-size: 19px;
    color: rgba(255,255,255,0.9);
    max-width: 750px;
    margin: 0 auto;
    line-height: 1.8;
}

/* CONTENT WRAP */
.wrap-sejarah{
    position: relative;
    max-width: 1000px; 
    margin: -100px auto 80px;
    padding: 0 20px;
    z-index: 3;
    animation: fadeInUp 1.2s ease-out forwards;
    opacity: 0; /* Berhubungan dengan animasi forwards */
}

.box-sejarah{
    position: relative;
    background: #ffffff;
    border: 1px solid rgba(226, 232, 240, 0.8);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
    padding: 70px 80px;
    overflow: hidden;
}

/* Efek Glow di Pojok Kanan Atas Kotak */
.box-sejarah::before{
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, var(--primary), transparent 70%);
    opacity: 0.08;
    pointer-events: none;
}

/* Watermark Kutipan Raksasa */
.box-sejarah::after{
    content: '“';
    position: absolute;
    top: -20px;
    left: 30px;
    font-size: 250px;
    line-height: 1;
    font-family: serif;
    color: var(--primary);
    opacity: 0.04;
    pointer-events: none;
    z-index: 0;
}

/* Styling Khusus untuk Output CKEditor */
.isi-sejarah{
    position: relative;
    z-index: 1;
    font-size: 1.15rem;
    line-height: 2;
    color: #475569;
    text-align: justify; /* Teks dibikin rata kanan kiri */
}

/* Efek Drop Cap (Huruf besar ala majalah di paragraf pertama) */
.isi-sejarah > p:first-of-type::first-letter {
    float: left;
    font-size: 4.5rem;
    line-height: 0.8;
    font-weight: 800;
    color: var(--primary);
    margin-right: 15px;
    margin-bottom: -5px;
    padding: 10px 15px;
    background: rgba(25,135,84,0.08); /* Warna dasar ngikut primary tapi transparan */
    border-radius: 12px;
}

.isi-sejarah h1,
.isi-sejarah h2,
.isi-sejarah h3,
.isi-sejarah h4{
    color: var(--dark);
    margin-top: 1.8em;
    margin-bottom: 0.8em;
    font-weight: 800;
    position: relative;
    padding-bottom: 10px;
}

/* Garis bawah cantik untuk heading */
.isi-sejarah h2::after, .isi-sejarah h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 4px;
    background: var(--primary);
    border-radius: 2px;
}

.isi-sejarah p{
    margin-bottom: 1.5em;
}

.isi-sejarah a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    border-bottom: 2px dashed rgba(25,135,84,0.4);
    transition: 0.3s;
}

.isi-sejarah a:hover {
    border-bottom-color: var(--primary);
}

.isi-sejarah img{
    max-width: 100%;
    height: auto;
    border-radius: 20px;
    margin: 30px 0;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    display: block; 
    transition: transform 0.3s ease;
}

.isi-sejarah img:hover {
    transform: translateY(-5px);
}

/* Modifikasi Bullet Points */
.isi-sejarah ul {
    list-style: none;
    padding-left: 10px;
    margin-bottom: 1.5em;
}

.isi-sejarah ul li {
    position: relative;
    padding-left: 30px;
    margin-bottom: 12px;
}

.isi-sejarah ul li::before {
    content: '✦'; /* Bullet point custom */
    position: absolute;
    left: 0;
    color: var(--primary);
    font-size: 1.2rem;
    line-height: 1.5;
}

.isi-sejarah ol {
    padding-left: 25px;
    margin-bottom: 1.5em;
}

.isi-sejarah ol li::marker {
    color: var(--primary);
    font-weight: 700;
}

.isi-sejarah blockquote{
    margin: 35px 0;
    padding: 25px 30px;
    border-left: 5px solid var(--primary);
    background: #f8fafc;
    border-radius: 0 16px 16px 0;
    font-style: italic;
    font-size: 1.2rem;
    color: #334155;
    box-shadow: inset 0 2px 10px rgba(0,0,0,0.02);
}

/* RESPONSIVE */
@media (max-width: 992px){
    .hero-sejarah{ min-height: 400px; }
    .hero-sejarah h1{ font-size: 46px; }
    .box-sejarah{ padding: 50px 40px; }
    .isi-sejarah > p:first-of-type::first-letter { font-size: 3.5rem; }
}

@media (max-width: 768px){
    .hero-sejarah{ min-height: 350px; background-attachment: scroll; }
    .hero-sejarah h1{ font-size: 36px; }
    .hero-sejarah p{ font-size: 16px; }
    .wrap-sejarah{ margin-top: -60px; }
    .box-sejarah{ padding: 35px 25px; border-radius: 20px; }
    .isi-sejarah{ font-size: 1rem; line-height: 1.8; text-align: left; }
    .isi-sejarah > p:first-of-type::first-letter { font-size: 3rem; padding: 8px 12px; margin-right: 10px;}
    .box-sejarah::after { font-size: 150px; top: -10px; left: 10px;}
}
</style>

<div class="hero-sejarah">
    <div class="hero-inner">
        <div class="hero-badge">Profil Sekolah</div>
        <h1>Sejarah Sekolah</h1>
        <p>Menelusuri perjalanan, perkembangan, dan semangat pendidikan yang menjadi fondasi kami hingga hari ini.</p>
    </div>
</div>

<div class="wrap-sejarah">
    <div class="box-sejarah">
        <div class="isi-sejarah">
            <?php if(empty(trim(strip_tags($content)))): ?>
                <div class="text-center py-5">
                    <div class="display-1 text-muted opacity-25 mb-3"><i class="bi bi-clock-history"></i></div>
                    <h4 class="text-muted">Sejarah Belum Ditulis</h4>
                    <p class="text-muted">Konten sejarah sekolah saat ini belum diisi oleh administrator.</p>
                </div>
            <?php else: ?>
                <?= $content ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
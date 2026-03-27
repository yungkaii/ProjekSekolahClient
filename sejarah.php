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
    --radius-lg: 18px;
}

body{
    background:
        radial-gradient(circle at top left, rgba(25,135,84,0.08), transparent 25%),
        radial-gradient(circle at top right, rgba(25,135,84,0.06), transparent 20%),
        linear-gradient(180deg, #f8fafc 0%, #eef3f8 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: var(--text);
}

/* HERO */
.hero-sejarah{
    position: relative;
    min-height: 420px;
    background:
        linear-gradient(135deg, rgba(15,23,42,0.80), rgba(15,23,42,0.45)),
        url('<?= $bg_image ?>');
    background-size: cover;
    background-position: center;
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
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.10), transparent 25%),
        radial-gradient(circle at 80% 30%, rgba(255,255,255,0.07), transparent 20%);
}

.hero-inner{
    position: relative;
    z-index: 2;
    max-width: 900px;
    padding: 30px 20px;
}

.hero-badge{
    display: inline-block;
    background: rgba(255,255,255,0.14);
    border: 1px solid rgba(255,255,255,0.20);
    color: #fff;
    padding: 8px 18px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 18px;
    backdrop-filter: blur(8px);
}

.hero-sejarah h1{
    font-size: 52px;
    font-weight: 800;
    margin-bottom: 14px;
    letter-spacing: 0.5px;
    line-height: 1.15;
}

.hero-sejarah p{
    font-size: 18px;
    color: rgba(255,255,255,0.88);
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.7;
}

/* CONTENT WRAP */
.wrap-sejarah{
    position: relative;
    max-width: 1120px;
    margin: -90px auto 70px;
    padding: 0 20px;
    z-index: 3;
}

.box-sejarah{
    position: relative;
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.7);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow);
    padding: 50px;
    overflow: hidden;
}

.box-sejarah::before{
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 220px;
    height: 220px;
    background: radial-gradient(circle, rgba(25,135,84,0.12), transparent 70%);
    pointer-events: none;
}

.header-sejarah{
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 28px;
    flex-wrap: wrap;
}

.icon-sejarah{
    width: 62px;
    height: 62px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary), #0f766e);
    color: white;
    font-size: 28px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    flex-shrink: 0;
}

.judul-wrap{
    flex: 1;
}

.label-kecil{
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--primary);
    margin-bottom: 6px;
}

.judul-sejarah{
    font-size: 34px;
    font-weight: 800;
    line-height: 1.2;
    margin: 0;
    color: var(--dark);
}

.subjudul-sejarah{
    font-size: 15px;
    color: var(--muted);
    margin-top: 8px;
}

.garis{
    width: 90px;
    height: 5px;
    margin: 24px 0 30px;
    border-radius: 999px;
    background: linear-gradient(90deg, var(--primary), transparent);
}

.isi-sejarah{
    font-size: 17px;
    line-height: 2;
    color: #475569;
    text-align: justify;
}

.isi-sejarah h1,
.isi-sejarah h2,
.isi-sejarah h3,
.isi-sejarah h4{
    color: var(--dark);
    margin-top: 30px;
    margin-bottom: 14px;
    font-weight: 700;
}

.isi-sejarah p{
    margin-bottom: 18px;
}

.isi-sejarah img{
    max-width: 100%;
    height: auto;
    border-radius: 16px;
    margin: 20px 0;
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

.isi-sejarah ul,
.isi-sejarah ol{
    padding-left: 22px;
    margin-bottom: 18px;
}

.isi-sejarah blockquote{
    margin: 24px 0;
    padding: 18px 22px;
    border-left: 4px solid var(--primary);
    background: rgba(25,135,84,0.06);
    border-radius: 0 14px 14px 0;
    color: #334155;
}

/* INFO STRIP */
.info-strip{
    margin-top: 35px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.info-item{
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: var(--radius-lg);
    padding: 20px;
    box-shadow: 0 8px 20px rgba(15,23,42,0.05);
}

.info-item h4{
    margin: 0 0 8px;
    font-size: 16px;
    color: var(--dark);
}

.info-item p{
    margin: 0;
    font-size: 14px;
    color: var(--muted);
    line-height: 1.7;
}

/* RESPONSIVE */
@media (max-width: 992px){
    .hero-sejarah{
        min-height: 360px;
    }

    .hero-sejarah h1{
        font-size: 42px;
    }

    .box-sejarah{
        padding: 38px 28px;
    }

    .info-strip{
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px){
    .hero-sejarah{
        min-height: 300px;
    }

    .hero-sejarah h1{
        font-size: 32px;
    }

    .hero-sejarah p{
        font-size: 15px;
    }

    .wrap-sejarah{
        margin-top: -55px;
    }

    .box-sejarah{
        padding: 28px 20px;
        border-radius: 20px;
    }

    .judul-sejarah{
        font-size: 26px;
    }

    .isi-sejarah{
        font-size: 15.8px;
        line-height: 1.9;
        text-align: left;
    }

    .header-sejarah{
        align-items: flex-start;
    }

    .icon-sejarah{
        width: 54px;
        height: 54px;
        font-size: 24px;
        border-radius: 14px;
    }
}
</style>

<div class="hero-sejarah">
    <div class="hero-inner">
        <div class="hero-badge">Profil Sekolah</div>
        <h1>Sejarah Sekolah</h1>
        <p>
            Menelusuri perjalanan, perkembangan, dan semangat pendidikan
            yang menjadi fondasi SMP Bina Karya Kreatif hingga hari ini.
        </p>
    </div>
</div>

<div class="wrap-sejarah">
    <div class="box-sejarah">
        <div class="header-sejarah">
            <div class="icon-sejarah">🏫</div>
            <div class="judul-wrap">
                <div class="label-kecil">Tentang Kami</div>
                <h2 class="judul-sejarah">SMP Bina Karya Kreatif</h2>
                <div class="subjudul-sejarah">
                    Membangun generasi unggul melalui pendidikan, karakter, dan kreativitas.
                </div>
            </div>
        </div>

        <div class="garis"></div>

        <div class="isi-sejarah">
            <?= $content ?>
        </div>

        <div class="info-strip">
            <div class="info-item">
                <h4>Visi Perjalanan</h4>
                <p>Sejarah sekolah menjadi cerminan nilai, perjuangan, dan arah masa depan pendidikan.</p>
            </div>
            <div class="info-item">
                <h4>Nilai Utama</h4>
                <p>Integritas, kreativitas, kedisiplinan, dan semangat belajar menjadi fondasi pertumbuhan.</p>
            </div>
            <div class="info-item">
                <h4>Komitmen Sekolah</h4>
                <p>Memberikan lingkungan belajar yang inspiratif, nyaman, dan mendorong potensi siswa.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
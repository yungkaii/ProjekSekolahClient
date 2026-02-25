<?php 
// 1. Hubungkan ke Database & Tampilan Dasar
include 'config/koneksi.php';
include 'includes/header.php';

// =========================================================================
// TAMBAHAN: FONT OPEN SANS (Disuntikkan disini agar menimpa font bawaan)
// =========================================================================
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    /* Paksa semua elemen menggunakan Open Sans */
    body, h1, h2, h3, h4, h5, h6, p, a, span, div, li, small {
        font-family: 'Open Sans', sans-serif !important;
    }
    
    /* Perbaikan agar Navbar tidak berantakan fontnya */
    .navbar-brand, .nav-link {
        font-family: 'Open Sans', sans-serif !important;
    }

    /* Hero sambutan improvements */
    .hero-section {
        position: relative;
        background-size: cover;
        background-position: center;
        color: #fff;
    }
    /* Styling for kepala sekolah section (#tentang) */
    .sambutan-card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .sambutan-card h4, .sambutan-card h2 {
        color: #0f5132;
    }
    .sambutan-card .text-secondary {
        color: #495057;
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
    }
    .hero-content {
        position: relative;
        z-index: 2;
        padding: 6rem 0;
    }
    .hero-text-box {
        background: rgba(255,255,255,0.1);
        padding: 2rem 2.5rem;
        border-radius: 12px;
        backdrop-filter: blur(5px);
        display: inline-block;
    }
    .hero-content h1 {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
    }
    .hero-content p.lead {
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
    }

    /* Styling untuk box visi & misi yang lebih menarik */
    .box-visi, .box-misi {
        border: none;
        border-radius: 12px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    /* Gallery section improvements */
    #galeri .card img {
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    #galeri .card:hover img {
        transform: scale(1.05);
    }
    #galeri .card-footer {
        background: rgba(0,0,0,0.6);
        transition: background 0.3s;
    }
    #galeri .card:hover .card-footer {
        background: rgba(0,0,0,0.8);
    }
    #galeri .card-footer h5 {
        font-size: 1rem;
    }
    .box-visi {
        background: linear-gradient(135deg, #e0f7fa 0%, #ffffff 100%);
    }
    .box-misi {
        background: linear-gradient(135deg, #f1f8e9 0%, #ffffff 100%);
    }
    .box-visi::before,
    .box-misi::before {
        content: '';
        position: absolute;
        width: 120px;
        height: 120px;
        opacity: 0.1;
        border-radius: 50%;
        top: -20px;
        right: -20px;
    }
    .box-visi::before {
        background: url('https://cdn-icons-png.flaticon.com/512/190/190411.png') no-repeat center/contain;
    }
    .box-misi::before {
        /* question mark icon to suggest uncertainty */
        background: url('https://cdn-icons-png.flaticon.com/512/545/545682.png') no-repeat center/contain;
    }
</style>
<?php 
// =========================================================================

include 'includes/navbar.php';

// 2. Ambil Data Profil Sekolah (Untuk Hero & Tentang Kami)
$q_profil = mysqli_query($koneksi, "SELECT * FROM profil_sekolah WHERE id=1");
$p = mysqli_fetch_assoc($q_profil);

// 3. Logika Gambar Banner (Hero Image)
// Cek apakah admin sudah upload gambar hero? Dan apakah filenya ada di folder?
$gambar_hero = "https://source.unsplash.com/random/1920x1080/?school_building"; // Default jika kosong

if(!empty($p['gambar_hero']) && file_exists("assets/img_sekolah/".$p['gambar_hero'])){
    $gambar_hero = "assets/img_sekolah/" . $p['gambar_hero'];
}
?>

<section class="hero-section" style="background-image: url('<?= $gambar_hero ?>');">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="hero-text-box text-center">
                <h1 class="display-3 fw-bold">Selamat Datang di <br><?= $p['nama_sekolah'] ?? 'Sekolah Purwanida' ?></h1>
                <p class="lead mt-4 text-white"><?= $p['deskripsi_hero'] ?? 'Mencetak Generasi Cerdas, Berkarakter, dan Berakhlak Mulia' ?></p>
                <a href="#tentang" class="btn btn-success btn-lg btn-rounded mt-3 px-5">Selengkapnya</a>
            </div>
        </div>
    </div>
</section>

<section id="tentang" class="section py-6 bg-white">
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4">
                <?php
                // Cek apakah admin sudah upload foto profil?
                if(!empty($p['gambar_profil']) && file_exists("assets/img_sekolah/".$p['gambar_profil'])){
                    $img_profil = "assets/img_sekolah/" . $p['gambar_profil'];
                } else {
                    // Gambar cadangan jika belum ada upload
                    $img_profil = "https://source.unsplash.com/random/600x400/?teacher,headmaster"; 
                }
                ?>
                    <div class="text-center">
                        <img src="<?= $img_profil ?>" 
                            class="img-fluid rounded-3 shadow" 
                            alt="Tentang Kami" 
                            style="max-height: 350px; width: auto; max-width: 100%; object-fit: cover;">
                        </div>            
                    </div>
            
            <div class="col-md-6">
                <div class="sambutan-card">
                    <h4 class="text-success fw-bold">Tentang Kami</h4>
                    <h2 class="mb-4 fw-bold">Sambutan Kepala Sekolah</h2>
                    
                    <div class="text-secondary" style="line-height: 1.8; text-align: justify;">
                        <?= nl2br($p['isi_profil'] ?? 'Selamat datang di website resmi sekolah kami.') ?>
                    </div>
                    
                    <ul class="list-unstyled mt-4">
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> 
                        <?= !empty($p['keunggulan_1']) ? $p['keunggulan_1'] : 'Kurikulum Berkualitas' ?>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> 
                        <?= !empty($p['keunggulan_2']) ? $p['keunggulan_2'] : 'Fasilitas Lengkap' ?>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> 
                        <?= !empty($p['keunggulan_3']) ? $p['keunggulan_3'] : 'Ekstrakurikuler Aktif' ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- New visi & misi section below sambutan -->
<section id="visi-misi" class="section py-6 bg-light">
    <div class="container my-5">
        <div class="text-center mb-5">
            <h4 class="text-success fw-bold" style="font-size:2rem;">Visi &amp; Misi</h4>
        </div>
        <div class="row g-4">
            <!-- Visi box -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-success box-visi">
                    <div class="card-body">
                        <h5 class="card-title text-success fw-bold" style="font-size:1.25rem;">Visi</h5>
                        <p class="card-text text-secondary" style="font-size:1rem; line-height:1.6;">
                            <?php if(!empty($p['visi'])): ?>
                                <?= nl2br($p['visi']) ?>
                            <?php else: ?>
                                <span class="fst-italic">Visi belum diset. Silakan atur di pengaturan admin.</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Misi box -->
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-success box-misi">
                    <div class="card-body">
                        <h5 class="card-title text-success fw-bold" style="font-size:1.25rem;">Misi</h5>
                        <div class="card-text text-secondary" style="font-size:1rem; line-height:1.6;">
                            <?php if(!empty($p['misi'])): ?>
                                <ul style="padding-left:1.2rem;">
                                    <?php foreach(explode("\n", $p['misi']) as $m){
                                        $m=trim($m);
                                        if($m!=='') echo "<li>".htmlspecialchars($m)."</li>";
                                    } ?>
                                </ul>
                            <?php else: ?>
                                <span class="fst-italic">Misi belum diset. Silakan atur di pengaturan admin.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="berita" class="section py-6 bg-light">
    <div class="container my-5">
        <div class="text-center mb-5">
            <h4 class="text-success fw-bold">Informasi Terkini</h4>
            <h2 class="section-title d-inline-block text-dark">Berita Sekolah</h2>
        </div>
        
        <div class="row g-4">
            <?php
            // Query: Ambil 3 berita terakhir
            $q_berita = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC LIMIT 3");
            
            // Cek jika ada berita
            if(mysqli_num_rows($q_berita) > 0){
                while($b = mysqli_fetch_assoc($q_berita)){
                    // Cek gambar berita
                    $img_berita = $b['gambar'] ? "assets/img_berita/".$b['gambar'] : "https://via.placeholder.com/400x200";
            ?>
            <div class="col-6 col-md-4">
                <div class="card card-custom h-100 bg-white shadow-sm border-0">
                    <img src="<?= $img_berita ?>" class="card-img-top" alt="Berita" style="height: 220px; object-fit: cover;">
                    <div class="card-body">
                        <small class="text-muted"><i class="bi bi-calendar-event me-1"></i> <?= $b['tanggal'] ?></small>
                        <h5 class="fw-bold mt-2 mb-3 text-dark"><?= $b['judul'] ?></h5>
                        <p class="text-secondary"><?= substr(strip_tags($b['isi']), 0, 90) ?>...</p>
                        <a href="detail_berita.php?id=<?= $b['id'] ?>" class="btn btn-sm btn-outline-success rounded-pill mt-2">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php 
                }
            } else {
                echo "<div class='col-12 text-center text-muted'><i>Belum ada berita yang diposting.</i></div>";
            }
            ?>
        </div>
    </div>
</section>

<section id="galeri" class="section py-6 bg-white">
    <div class="container my-5">
        <div class="text-center mb-5">
            <h4 class="text-success fw-bold">Dokumentasi</h4>
            <h2 class="section-title d-inline-block text-dark">Galeri Kegiatan</h2>
        </div>

        <div class="row g-3">
            <?php
            // Cek dulu apakah tabel galeri ada untuk menghindari error
            $cek_tabel = mysqli_query($koneksi, "SHOW TABLES LIKE 'galeri'");
            
            if(mysqli_num_rows($cek_tabel) > 0){
                // Jika tabel ada, ambil data
                $q_galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC LIMIT 6");
                
                if(mysqli_num_rows($q_galeri) > 0){
                    while($g = mysqli_fetch_assoc($q_galeri)){
                        // Pastikan path folder sesuai
                        $img_galeri = "assets/img_galeri/" . $g['gambar'];
                        
                        // Cek apakah kolom judul ada datanya, jika tidak kosongkan
                        $judul_galeri = isset($g['judul']) ? $g['judul'] : ""; 
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 shadow rounded-3 overflow-hidden h-100 position-relative">
                    <img src="<?= $img_galeri ?>" class="w-100" alt="Galeri" style="height: 250px; object-fit: cover;">
                    <div class="card-footer position-absolute bottom-0 start-0 w-100 p-3 text-center text-white" style="background: rgba(0,0,0,0.6);">
                        <h5 class="fw-bold mb-0"><?= $judul_galeri ?></h5>
                    </div>
                </div>
            </div>
            <?php 
                    } 
                } else {
                    echo "<div class='col-12 text-center text-muted'>Belum ada foto di galeri.</div>";
                }
            } else {
                echo "<div class='col-12 text-center text-danger'>Tabel 'galeri' belum dibuat di database.</div>";
            }
            ?>
        </div>
    </div>
</section>

<section id="ekskul" class="py-6 bg-light">
    <div class="container my-5">
        
        <div class="text-center mb-5">
            <h5 class="text-success fw-semibold text-uppercase">Pengembangan Diri</h5>
            <h2 class="fw-bold display-6">Ekstrakurikuler</h2>
            <div class="mx-auto mt-3" style="width:80px;height:4px;background:#198754;border-radius:10px;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
            $cek_ekskul = mysqli_query($koneksi, "SHOW TABLES LIKE 'ekstrakurikuler'");
            if(mysqli_num_rows($cek_ekskul) > 0){
                $q_ekskul = mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler ORDER BY id DESC");
                if(mysqli_num_rows($q_ekskul) > 0){
                    while($e = mysqli_fetch_assoc($q_ekskul)){
            ?>
            
            <div class="col-lg-4 col-md-6">
                <div class="card ekskul-card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    
                    <div class="img-wrapper position-relative">
                        <img src="assets/img_ekskul/<?= $e['gambar'] ?>" 
                             class="w-100" 
                             alt="<?= $e['nama_ekskul'] ?>">
                        <div class="overlay"></div>
                    </div>
                    
                    <div class="card-body text-center py-4">
                        <h5 class="fw-bold mb-0"><?= $e['nama_ekskul'] ?></h5>
                    </div>

                </div>
            </div>

            <?php 
                    }
                } else {
                    echo "<div class='text-center text-muted'>Belum ada data ekskul.</div>";
                }
            }
            ?>
        </div>
    </div>
</section>

<style>
.ekskul-card {
    transition: all 0.3s ease;
}

.ekskul-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.img-wrapper {
    height: 230px;
    overflow: hidden;
}

.img-wrapper img {
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.ekskul-card:hover img {
    transform: scale(1.1);
}

.overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
}
</style>

<?php include 'includes/footer.php'; ?>
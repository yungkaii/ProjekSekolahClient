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
        <h1 class="display-3 fw-bold">Selamat Datang di <br><?= $p['nama_sekolah'] ?? 'Sekolah Purwanida' ?></h1>
        <p class="lead mt-4 text-white"><?= $p['deskripsi_hero'] ?? 'Mencetak Generasi Cerdas, Berkarakter, dan Berakhlak Mulia' ?></p>
        <a href="#tentang" class="btn btn-success btn-lg rounded-pill mt-3 px-5">Selengkapnya</a>
    </div>
</section>

<section id="tentang" class="py-5 bg-white">
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

<section id="berita" class="py-5 bg-light">
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

<section id="galeri" class="py-5 bg-white">
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
                <div class="card border-0 shadow rounded-3 overflow-hidden h-100">
                    
                    <img src="<?= $img_galeri ?>" class="w-100" alt="Galeri" style="height: 250px; object-fit: cover;">
                    
                    <div class="card-footer bg-dark border-0 p-3 text-center">
                        <h5 class="fw-bold mb-0 text-white"><?= $judul_galeri ?></h5>
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

<section id="ekskul" class="py-5 bg-light">
    <div class="container my-5">
        <div class="text-center mb-5">
            <h4 class="text-success fw-bold">Pengembangan Diri</h4>
            <h2 class="section-title d-inline-block text-dark">Ekstrakurikuler</h2>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
            // Pastikan koneksi sudah ada
            // include 'config/koneksi.php'; (Jika belum ada di atas)
            
            $cek_ekskul = mysqli_query($koneksi, "SHOW TABLES LIKE 'ekstrakurikuler'");
            if(mysqli_num_rows($cek_ekskul) > 0){
                $q_ekskul = mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler ORDER BY id DESC");
                if(mysqli_num_rows($q_ekskul) > 0){
                    while($e = mysqli_fetch_assoc($q_ekskul)){
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden hover-effect">
                    <div style="height: 220px; overflow: hidden;">
                        <img src="assets/img_ekskul/<?= $e['gambar'] ?>" class="w-100 h-100" style="object-fit: cover; transition: 0.3s;" alt="<?= $e['nama_ekskul'] ?>">
                    </div>
                    
                    <div class="card-body text-center p-4">
                        <h4 class="fw-bold text-dark mb-0"><?= $e['nama_ekskul'] ?></h4>
                    </div>
                </div>
            </div>
            <?php 
                    }
                } else { echo "<div class='text-center text-muted'>Belum ada data ekskul.</div>"; }
            }
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
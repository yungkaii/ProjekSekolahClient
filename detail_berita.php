<?php
include 'config/koneksi.php';
include 'includes/header.php'; // Header yang sama
include 'includes/navbar.php'; // Navbar yang sama

// 1. Tangkap ID dari URL
// (int) digunakan untuk keamanan, memastikan input hanya angka
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. Ambil data berita berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM berita WHERE id = '$id'");
$data  = mysqli_fetch_assoc($query);

// Jika berita tidak ditemukan (misal ID ngawur)
if(mysqli_num_rows($query) == 0) {
    echo "<div class='container my-5 text-center'>
            <h2>Berita tidak ditemukan!</h2>
            <a href='index.php' class='btn btn-primary mt-3'>Kembali ke Beranda</a>
          </div>";
    include 'includes/footer.php';
    exit;
}

// Cek gambar (apakah ada atau pakai placeholder)
$gambar = $data['gambar'] ? "assets/img_berita/".$data['gambar'] : "https://via.placeholder.com/800x400";
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="index.php#berita" class="text-decoration-none text-secondary mb-3 d-inline-block">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>

            <h1 class="fw-bold mb-3"><?= $data['judul'] ?></h1>
            
            <div class="text-muted mb-4">
                <i class="bi bi-calendar-event me-2"></i> <?= $data['tanggal'] ?>
            </div>

            <div class="mb-4 rounded-3 overflow-hidden shadow-sm">
                <img src="<?= $gambar ?>" class="w-100" alt="<?= $data['judul'] ?>" style="max-height: 500px; object-fit: cover;">
            </div>

            <div class="content-text fs-5" style="line-height: 1.8; text-align: justify; word-wrap: break-word; overflow-wrap: break-word;">
                <?= nl2br($data['isi']) ?>
            </div>

            <hr class="my-5">

            <div class="text-center">
                <p class="text-muted">Bagikan berita ini:</p>
                <button class="btn btn-outline-success btn-sm"><i class="bi bi-whatsapp"></i> WhatsApp</button>
                <button class="btn btn-outline-primary btn-sm"><i class="bi bi-facebook"></i> Facebook</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
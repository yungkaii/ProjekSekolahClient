<?php
if(isset($koneksi)){
    $q_info = mysqli_query($koneksi, "SELECT nama_sekolah, logo FROM profil_sekolah WHERE id=1");
    $d_info = mysqli_fetch_assoc($q_info);
    $nama_sekolah = $d_info ? $d_info['nama_sekolah'] : "Sekolah Purwanida";
    $logo_file = $d_info && !empty($d_info['logo']) ? $d_info['logo'] : '';
} else {
    $nama_sekolah = "Sekolah Purwanida";
    $logo_file = '';
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
  <div class="container-fluid px-4"> 
    <a class="navbar-brand fw-bold text-success d-flex align-items-center" href="index.php">
        <?php if(!empty($logo_file) && file_exists('assets/img/'.$logo_file)): ?>
            <img src="assets/img/<?= $logo_file ?>" alt="Logo" height="40" class="me-2" style="object-fit: contain;" />
        <?php else: ?>
            <i class="bi bi-mortarboard-fill me-2"></i>
        <?php endif; ?>
        <?= $nama_sekolah ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link fw-bold mx-2" href="index.php" onclick="scrollToTop(event)">Beranda</a></li>
        <li class="nav-item"><a class="nav-link fw-bold mx-2" href="index.php#tentang">Tentang Kami</a></li>
        <li class="nav-item"><a class="nav-link fw-bold mx-2" href="index.php#berita">Berita</a></li>
        <li class="nav-item"><a class="nav-link fw-bold mx-2" href="index.php#galeri">Galeri</a></li>
        <li class="nav-item"><a class="nav-link fw-bold mx-2" href="index.php#ekskul">Ekstrakurikuler</a></li>
        <li class="nav-item"><a class="nav-link fw-bold mx-2" href="#kontak">Kontak</a></li>
        <li class="nav-item">
            <a class="nav-link btn btn-success text-white ms-lg-3 px-4 rounded-pill" href="admin/login.php">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script>
function scrollToTop(event) {
    event.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
</script>
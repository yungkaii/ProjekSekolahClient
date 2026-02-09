<?php
if(isset($koneksi)){
    $q_info = mysqli_query($koneksi, "SELECT nama_sekolah FROM profil_sekolah WHERE id=1");
    $d_info = mysqli_fetch_assoc($q_info);
    $nama_sekolah = $d_info ? $d_info['nama_sekolah'] : "Sekolah Purwanida";
} else {
    $nama_sekolah = "Sekolah Purwanida";
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
  <div class="container-fluid px-4"> 
    <a class="navbar-brand fw-bold text-success" href="index.php">
        <i class="bi bi-mortarboard-fill me-2"></i> <?= $nama_sekolah ?>
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
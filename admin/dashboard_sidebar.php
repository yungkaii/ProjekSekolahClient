<?php
// Reusable admin sidebar used by custom admin editor pages
?>
<div class="sidebar col-md-2 d-none d-md-block p-3">
    <h4 class="fw-bold text-center text-white mb-4 mt-2">ADMIN</h4>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="bi bi-grid-fill me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="berita.php"><i class="bi bi-newspaper me-2"></i> Kelola Berita</a></li>
        <li class="nav-item"><a class="nav-link" href="galeri.php"><i class="bi bi-images me-2"></i> Kelola Galeri</a></li>
        <li class="nav-item"><a class="nav-link" href="ekskul.php"><i class="bi bi-stars me-2"></i> Ekstrakurikuler</a></li>

        <li class="nav-item mt-3">
            <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#pengaturanCollapse" role="button" aria-expanded="false" aria-controls="pengaturanCollapse">
                <span><i class="bi bi-gear-fill me-2"></i> Pengaturan</span>
                <i class="bi bi-caret-down-fill"></i>
            </a>
            <?php
$active = basename($_SERVER['PHP_SELF']);
$openPages = ['pengaturan.php','sejarah.php','komite.php','kurikulum.php','kesiswaan.php','sarpras.php','struktur_organisasi.php'];
$collapseClass = in_array($active, $openPages) ? 'collapse ps-3 show' : 'collapse ps-3';
?>
<div class="<?= $collapseClass ?>" id="pengaturanCollapse">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="pengaturan.php">Pengaturan Website</a></li>
                    <li class="nav-item"><a class="nav-link" href="sejarah.php">Sejarah Sekolah</a></li>
                    <li class="nav-item"><a class="nav-link" href="komite.php">Komite Sekolah</a></li>
                    <li class="nav-item"><a class="nav-link" href="kurikulum.php">Kurikulum</a></li>
                    <li class="nav-item"><a class="nav-link" href="kesiswaan.php">Kesiswaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="sarpras.php">Sarana &amp; Prasarana</a></li>
                    <li class="nav-item"><a class="nav-link" href="struktur_organisasi.php">Struktur Organisasi</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item mt-4"><a class="nav-link text-danger" href="logout.php"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
    </ul>
</div>

<script>
// sidebar active link & collapse auto-open
document.addEventListener('DOMContentLoaded', function(){
    var path = window.location.pathname.split('/').pop();
    if(!path) return;
    var link = document.querySelector('.sidebar a.nav-link[href="'+path+'"]');
    if(link){
        link.classList.add('active');
        var collapseDiv = link.closest('.collapse');
        if(collapseDiv){
            new bootstrap.Collapse(collapseDiv, {toggle:false}).show();
        }
    }
});
</script>

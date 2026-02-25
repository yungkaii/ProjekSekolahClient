<?php
// retrieve contact info for footer (queried every time include loaded)
$contact = [];
if(isset($koneksi)){
    // make sure columns exist, similar to admin/proses.php
    $cols = ['alamat','telepon','email','jam_operasional','facebook','instagram','youtube','map_embed'];
    foreach($cols as $col){
        $check = mysqli_query($koneksi, "SHOW COLUMNS FROM profil_sekolah LIKE '$col'");
        if(mysqli_num_rows($check) == 0){
            mysqli_query($koneksi, "ALTER TABLE profil_sekolah ADD COLUMN $col TEXT NULL");
        }
    }
    
    $q = mysqli_query($koneksi, "SELECT nama_sekolah, deskripsi_hero, alamat, telepon, email, jam_operasional, facebook, instagram, youtube, map_embed FROM profil_sekolah WHERE id=1");
    if($q){
        $contact = mysqli_fetch_assoc($q) ?: [];
    } else {
        // query failed; return empty to avoid fatal
        //error_log('Footer query failed: '.mysqli_error($koneksi));
        $contact = [];
    }
}
?>

<footer id="kontak" class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h4 class="fw-bold text-success mb-3"><?= htmlspecialchars($contact['nama_sekolah'] ?? 'Sekolah Purwanida') ?></h4>
                <p class="text-secondary">
                    <?= htmlspecialchars($contact['deskripsi_hero'] ?? 'Mewujudkan pendidikan berkualitas untuk melahirkan generasi yang cerdas, kreatif, dan berakhlak mulia.') ?>
                </p>
                <div class="d-flex gap-3">
                    <?php if(!empty($contact['facebook'])): ?><a href="<?= htmlspecialchars($contact['facebook']) ?>" class="text-white"><i class="bi bi-facebook fs-4"></i></a><?php endif; ?>
                    <?php if(!empty($contact['instagram'])): ?><a href="<?= htmlspecialchars($contact['instagram']) ?>" class="text-white"><i class="bi bi-instagram fs-4"></i></a><?php endif; ?>
                    <?php if(!empty($contact['youtube'])): ?><a href="<?= htmlspecialchars($contact['youtube']) ?>" class="text-white"><i class="bi bi-youtube fs-4"></i></a><?php endif; ?>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-decoration-none text-secondary mb-2 d-block">Beranda</a></li>
                    <li><a href="index.php#tentang" class="text-decoration-none text-secondary mb-2 d-block">Tentang Kami</a></li>
                    <li><a href="index.php#berita" class="text-decoration-none text-secondary mb-2 d-block">Berita Sekolah</a></li>
                    <li><a href="index.php#galeri" class="text-decoration-none text-secondary mb-2 d-block">Galeri Foto</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                <ul class="list-unstyled text-secondary">
                    <?php if(!empty($contact['alamat'])): ?>
                    <li class="mb-3">
                        <i class="bi bi-geo-alt-fill text-success me-2"></i>
                        <?= htmlspecialchars($contact['alamat']) ?>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($contact['telepon'])): ?>
                    <li class="mb-3">
                        <i class="bi bi-telephone-fill text-success me-2"></i>
                        <?= htmlspecialchars($contact['telepon']) ?>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($contact['email'])): ?>
                    <li class="mb-3">
                        <i class="bi bi-envelope-fill text-success me-2"></i>
                        <?= htmlspecialchars($contact['email']) ?>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($contact['jam_operasional'])): ?>
                    <li class="mb-3">
                        <i class="bi bi-clock-fill text-success me-2"></i>
                        <?= htmlspecialchars($contact['jam_operasional']) ?>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($contact['map_embed'])): ?>
                    <li class="mb-3">
                        <?= $contact['map_embed'] ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        
        <hr class="border-secondary my-4">
        
        <div class="text-center text-secondary">
            <p class="mb-0">&copy; <?= date('Y') ?> <?= htmlspecialchars($contact['nama_sekolah'] ?? 'Sekolah Purwanida') ?>. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
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

<<<<<<< HEAD
<footer id="kontak" class="bg-dark text-white pt-5 footer-new">

<style>

.footer-new{
background:linear-gradient(135deg,#020617,#0f172a);
}

.footer-new h4,
.footer-new h5{
margin-bottom:20px;
position:relative;
}

.footer-new h4::after,
.footer-new h5::after{

content:'';
width:40px;
height:3px;
background:#22c55e;
position:absolute;
bottom:-8px;
left:0;

}

.footer-link{

color:#94a3b8;
text-decoration:none;
display:block;
margin-bottom:8px;
transition:0.3s;

}

.footer-link:hover{

color:#22c55e;
padding-left:5px;

}

.footer-social{

width:38px;
height:38px;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
border:1px solid #22c55e;
transition:0.3s;

}

.footer-social:hover{

background:#22c55e;
transform:translateY(-3px);

}

.footer-contact i{

background:#22c55e;
color:#020617;
width:30px;
height:30px;
border-radius:50%;
display:inline-flex;
align-items:center;
justify-content:center;
margin-right:10px;

}

.footer-bottom{

border-top:1px solid #1e293b;
margin-top:30px;
padding-top:15px;

}

</style>


<div class="container">


<div class="row">


<div class="col-md-4 mb-4">


<h4 class="fw-bold text-success">

<?= htmlspecialchars($contact['nama_sekolah'] ?? 'Sekolah Purwanida') ?>

</h4>


<p class="text-secondary">

<?= htmlspecialchars($contact['deskripsi_hero'] ?? 'Mewujudkan pendidikan berkualitas untuk melahirkan generasi unggul.') ?>

</p>


<div class="d-flex gap-3">


<?php if(!empty($contact['facebook'])): ?>

<a href="<?= htmlspecialchars($contact['facebook']) ?>" class="footer-social text-white">

<i class="bi bi-facebook"></i>

</a>

<?php endif; ?>


<?php if(!empty($contact['instagram'])): ?>

<a href="<?= htmlspecialchars($contact['instagram']) ?>" class="footer-social text-white">

<i class="bi bi-instagram"></i>

</a>

<?php endif; ?>


<?php if(!empty($contact['youtube'])): ?>

<a href="<?= htmlspecialchars($contact['youtube']) ?>" class="footer-social text-white">

<i class="bi bi-youtube"></i>

</a>

<?php endif; ?>


</div>


</div>



<div class="col-md-4 mb-4">


<h5>Tautan Cepat</h5>


<ul class="list-unstyled">


<li>

<a href="index.php" class="footer-link">

Beranda

</a>

</li>


<li>

<a href="index.php#tentang" class="footer-link">

Tentang Kami

</a>

</li>


<li>

<a href="index.php#berita" class="footer-link">

Berita Sekolah

</a>

</li>


<li>

<a href="index.php#galeri" class="footer-link">

Galeri Foto

</a>

</li>


</ul>


</div>



<div class="col-md-4 mb-4 footer-contact">


<h5>Hubungi Kami</h5>



<?php if(!empty($contact['alamat'])): ?>

<div class="mb-3">

<i class="bi bi-geo-alt-fill"></i>

<?= htmlspecialchars($contact['alamat']) ?>

</div>

<?php endif; ?>



<?php if(!empty($contact['telepon'])): ?>

<div class="mb-3">

<i class="bi bi-telephone-fill"></i>

<?= htmlspecialchars($contact['telepon']) ?>

</div>

<?php endif; ?>



<?php if(!empty($contact['email'])): ?>

<div class="mb-3">

<i class="bi bi-envelope-fill"></i>

<?= htmlspecialchars($contact['email']) ?>

</div>

<?php endif; ?>



<?php if(!empty($contact['jam_operasional'])): ?>

<div class="mb-3">

<i class="bi bi-clock-fill"></i>

<?= htmlspecialchars($contact['jam_operasional']) ?>

</div>

<?php endif; ?>



<?php if(!empty($contact['map_embed'])): ?>

<div class="mt-3" style="border-radius:10px;overflow:hidden;">

<?= $contact['map_embed'] ?>

</div>

<?php endif; ?>



</div>


</div>



<div class="footer-bottom text-center text-secondary">


<p class="mb-0">

© <?= date('Y') ?>

<?= htmlspecialchars($contact['nama_sekolah'] ?? 'Sekolah Purwanida') ?>

All Rights Reserved.

</p>


</div>



</div>


=======
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
>>>>>>> 92e231ab83d5ac61c42aa5330edc5e9978199a6e
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include 'config/koneksi.php';
include 'includes/header.php';
include 'includes/navbar.php';

$content = 'Konten belum tersedia.';
$file = __DIR__ . '/assets/content/kesiswaan.html';
if(file_exists($file)){
    $content = file_get_contents($file);
}
?>
<section class="py-6">
    <div class="container">
        <div class="mb-4">
            <h1 class="fw-bold">Kesiswaan</h1>
        </div>
        <div class="card shadow-sm p-4">
            <?= $content ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

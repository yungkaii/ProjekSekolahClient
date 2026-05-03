<?php
include 'config/koneksi.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>
<section class="py-6">
    <div class="container">
        <div class="mb-5">
            <h1 class="fw-bold mb-2">Struktur Organisasi</h1>
            <p class="text-muted">Tim profesional yang siap melayani pendidikan berkualitas</p>
        </div>

        <div class="row" id="struktur-container">
            <?php
            // Cek apakah tabel ada
            $cek_tabel = mysqli_query($koneksi, "SHOW TABLES LIKE 'struktur_organisasi'");
            
            if(mysqli_num_rows($cek_tabel) > 0){
                $query = "SELECT * FROM struktur_organisasi ORDER BY urutan ASC, id ASC";
                $result = mysqli_query($koneksi, $query);
                
                if($result && mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        $foto = !empty($row['foto']) && file_exists("assets/img/" . $row['foto'])
                            ? "assets/img/" . $row['foto']
                            : "https://via.placeholder.com/200x200?text=" . urlencode($row['nama']);
                        ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm border-0" style="transition: transform 0.3s ease;">
                                <div style="height: 250px; overflow: hidden; background: #f8f9fa;">
                                    <img src="<?= htmlspecialchars($foto) ?>" alt="<?= htmlspecialchars($row['nama']) ?>" 
                                         class="card-img-top" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold mb-2"><?= htmlspecialchars($row['nama']) ?></h5>
                                    <p class="card-text text-muted mb-0">
                                        <small><?= htmlspecialchars($row['jabatan']) ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12"><div class="alert alert-info text-center">Belum ada data struktur organisasi.</div></div>';
                }
            } else {
                echo '<div class="col-12"><div class="alert alert-info text-center">Data struktur organisasi belum tersedia.</div></div>';
            }
            ?>
        </div>
    </div>
</section>

<style>
    #struktur-container .card {
        border-radius: 12px;
    }
    
    #struktur-container .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
    }
    
    #struktur-container .card-body {
        background: #fff;
        padding: 1.5rem 1rem;
    }
    
    #struktur-container .card-title {
        color: #1e293b;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
    
    #struktur-container .card-text {
        color: #64748b;
        font-size: 0.95rem;
    }
</style>

<?php include 'includes/footer.php'; ?>

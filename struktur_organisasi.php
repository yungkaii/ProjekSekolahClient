<?php
include 'config/koneksi.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
    --primary-color: #198754;
    --primary-dark: #146c43;
    --secondary-color: #20c997;
    --accent-color: #f59e0b;
    --dark-color: #14202b;
    --text-color: #334155;
    --muted-color: #64748b;
    --light-bg: #f7faf8;
    --white: #ffffff;
    --border-soft: rgba(15, 23, 42, 0.08);
    --shadow-sm: 0 10px 30px rgba(15, 23, 42, 0.06);
    --shadow-md: 0 18px 45px rgba(15, 23, 42, 0.10);
    --shadow-lg: 0 25px 60px rgba(15, 23, 42, 0.16);
    --radius-sm: 14px;
    --radius-md: 20px;
    --radius-lg: 28px;
    --transition-smooth: all 0.35s ease;
}

html{
    scroll-behavior: smooth;
}

body, h1, h2, h3, h4, h5, h6, p, a, span, div, li, small, strong {
    font-family: 'Open Sans', sans-serif !important;
}

body{
    color: var(--text-color);
    background:
        radial-gradient(circle at top left, rgba(25,135,84,0.07), transparent 20%),
        radial-gradient(circle at bottom right, rgba(32,201,151,0.06), transparent 22%),
        linear-gradient(180deg, #ffffff 0%, #f8fbf9 100%);
    overflow-x: hidden;
}

.section{
    position: relative;
    padding: 95px 0;
}

.section-soft{
    background: var(--light-bg);
}

.section-title-wrap{
    max-width: 760px;
    margin: 0 auto 55px;
    text-align: center;
}

.section-badge{
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 999px;
    background: rgba(25,135,84,0.10);
    color: var(--primary-color);
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: 1px solid rgba(25,135,84,0.10);
    margin-bottom: 18px;
}

.section-title{
    font-size: clamp(2rem, 3vw, 2.8rem);
    font-weight: 800;
    line-height: 1.2;
    color: var(--dark-color);
    margin-bottom: 12px;
    letter-spacing: -0.7px;
}

.section-subtitle{
    font-size: 1rem;
    line-height: 1.9;
    color: var(--muted-color);
    margin: 0;
}

/* Struktur Organisasi */
.struktur-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: var(--transition-smooth);
    display: flex;
    flex-direction: column;
    border: 1px solid var(--border-soft);
    height: 100%;
}

.struktur-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
}

.struktur-image-wrapper {
    position: relative;
    width: 100%;
    height: 280px;
    overflow: hidden;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
}

.struktur-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition-smooth);
}

.struktur-card:hover .struktur-image {
    transform: scale(1.08);
}

.struktur-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(20, 44, 59, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.struktur-card:hover .struktur-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    animation: slideUp 0.4s ease forwards;
}

.overlay-content h5 {
    color: var(--white);
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0 0 8px 0;
}

.overlay-content p {
    color: var(--secondary-color);
    margin: 0;
    font-weight: 700;
    font-size: 1.1rem;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.struktur-body {
    padding: 2rem 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.struktur-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--dark-color);
    margin: 0 0 1rem 0;
    letter-spacing: -0.5px;
}

.struktur-jabatan {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 0.5rem 1rem;
    border-radius: 999px;
    background: rgba(25, 135, 84, 0.10);
    color: var(--primary-color);
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 1rem;
    width: fit-content;
}

.struktur-divider {
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 2px;
    margin: 1rem 0;
}

.struktur-subtitle {
    color: var(--muted-color);
    font-size: 0.9rem;
    margin: 0;
    font-weight: 500;
}

@media (max-width: 768px) {
    .struktur-image-wrapper {
        height: 240px;
    }

    .struktur-name {
        font-size: 1.15rem;
    }

    .struktur-body {
        padding: 1.5rem 1.2rem;
    }

    .section{
        padding: 60px 0;
    }
}

@media (max-width: 480px) {
    .struktur-image-wrapper {
        height: 200px;
    }

    .struktur-body {
        padding: 1.2rem 1rem;
    }

    .struktur-name {
        font-size: 1.1rem;
    }

    .struktur-jabatan {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(28px); }
    to { opacity: 1; transform: translateY(0); }
}

.scroll-animate{
    animation: fadeInUp 0.8s ease both;
}

.delay-1{ animation-delay: 0.12s; }
.delay-2{ animation-delay: 0.24s; }
.delay-3{ animation-delay: 0.36s; }
</style>

<section class="section section-soft">
    <div class="container">
        <div class="section-title-wrap scroll-animate">
            <span class="section-badge">
            <h1 class="section-title">Struktur Organisasi</h1>
            <p class="section-subtitle">Tim profesional yang siap memberikan pendidikan berkualitas</p>
        </div>

        <div class="row" id="struktur-container" style="row-gap: 2.5rem;">
            <?php
            // Cek apakah tabel ada
            $cek_tabel = mysqli_query($koneksi, "SHOW TABLES LIKE 'struktur_organisasi'");
            
            if(mysqli_num_rows($cek_tabel) > 0){
                $query = "SELECT * FROM struktur_organisasi ORDER BY urutan ASC, id ASC";
                $result = mysqli_query($koneksi, $query);
                
                if($result && mysqli_num_rows($result) > 0){
                    $index = 0;
                    while($row = mysqli_fetch_array($result)){
                        $delay_class = "delay-" . (($index % 3) + 1);
                        $index++;
                        $foto = !empty($row['foto']) && file_exists("assets/img/" . $row['foto'])
                            ? "assets/img/" . $row['foto']
                            : "https://via.placeholder.com/300x280?text=" . urlencode($row['nama']);
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="struktur-card scroll-animate <?= $delay_class ?>">
                                <div class="struktur-image-wrapper">
                                    <img src="<?= htmlspecialchars($foto) ?>" alt="<?= htmlspecialchars($row['nama']) ?>" 
                                         class="struktur-image">
                                    <div class="struktur-overlay">
                                        <div class="overlay-content">
                                            <h5>Posisi</h5>
                                            <p><?= htmlspecialchars($row['jabatan']) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="struktur-body">
                                    <h4 class="struktur-name"><?= htmlspecialchars($row['nama']) ?></h4>
                                    <span class="struktur-jabatan">
                                        <i class="bi bi-person-check"></i>
                                        <?= htmlspecialchars($row['jabatan']) ?>
                                    </span>
                                    <div class="struktur-divider"></div>
                                    <p class="struktur-subtitle">Anggota Tim Sekolah</p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-12"><div style="background: rgba(25,135,84,0.08); border: 1px solid rgba(25,135,84,0.1); border-radius: var(--radius-md); padding: 40px; text-align: center; color: var(--primary-color);">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                            <p style="margin: 0; font-weight: 500;">Belum ada data struktur organisasi</p>
                          </div></div>';
                }
            } else {
                echo '<div class="col-12"><div style="background: rgba(25,135,84,0.08); border: 1px solid rgba(25,135,84,0.1); border-radius: var(--radius-md); padding: 40px; text-align: center; color: var(--primary-color);">
                        <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                        <p style="margin: 0; font-weight: 500;">Data struktur organisasi belum tersedia</p>
                      </div></div>';
            }
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

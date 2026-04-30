<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'config/koneksi.php';
include 'includes/header.php';
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

/* Breadcrumb */
.breadcrumb-wrapper{
    background: linear-gradient(135deg, rgba(25,135,84,0.08), rgba(32,201,151,0.05));
    padding: 18px 0;
    border-bottom: 1px solid rgba(25,135,84,0.10);
}

.breadcrumb{
    margin: 0;
    padding: 0;
    background: transparent;
}

.breadcrumb-item{
    color: var(--muted-color);
    font-weight: 600;
}

.breadcrumb-item.active{
    color: var(--primary-color);
    font-weight: 700;
}

.breadcrumb-item a{
    color: var(--primary-color);
    text-decoration: none;
    transition: var(--transition-smooth);
}

.breadcrumb-item a:hover{
    color: var(--primary-dark);
}

/* Guru Grid */
.guru-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
    margin-top: 45px;
}

.guru-card{
    position: relative;
    background: #fff;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(15,23,42,0.05);
    transition: var(--transition-smooth);
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.guru-card:hover{
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
}

.guru-photo{
    position: relative;
    height: 300px;
    overflow: hidden;
    background: linear-gradient(135deg, rgba(25,135,84,0.10), rgba(32,201,151,0.08));
}

.guru-photo img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.6s ease;
}

.guru-card:hover .guru-photo img{
    transform: scale(1.08);
}

.guru-badge{
    position: absolute;
    top: 16px;
    right: 16px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: #fff;
    padding: 8px 16px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 8px 20px rgba(25,135,84,0.25);
}

.guru-body{
    padding: 28px 22px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.guru-name{
    font-size: 1.3rem;
    font-weight: 800;
    color: var(--dark-color);
    margin-bottom: 8px;
    line-height: 1.3;
}

.guru-nip{
    font-size: 0.88rem;
    color: var(--muted-color);
    margin-bottom: 4px;
    font-weight: 600;
    letter-spacing: 0.3px;
}

.guru-position{
    font-size: 1.02rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 2px solid rgba(25,135,84,0.12);
}

.guru-detail{
    text-align: left;
    flex: 1;
    margin-bottom: 16px;
}

.guru-detail-item{
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 14px;
    font-size: 0.95rem;
    line-height: 1.7;
}

.guru-detail-item i{
    color: var(--secondary-color);
    font-weight: 700;
    margin-top: 2px;
    flex-shrink: 0;
}

.guru-detail-item span{
    color: var(--text-color);
}

.guru-empty{
    grid-column: 1 / -1;
    background: #fff;
    border-radius: var(--radius-lg);
    padding: 60px 30px;
    text-align: center;
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(15,23,42,0.05);
}

.guru-empty i{
    font-size: 3.2rem;
    color: var(--primary-color);
    display: block;
    margin-bottom: 18px;
    opacity: 0.6;
}

.guru-empty h4{
    font-weight: 800;
    color: var(--dark-color);
    margin-bottom: 10px;
    font-size: 1.3rem;
}

.guru-empty p{
    color: var(--muted-color);
    margin: 0;
}

/* Filter Section */
.guru-filter{
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 30px;
}

.filter-btn{
    padding: 10px 18px;
    background: #fff;
    border: 2px solid rgba(25,135,84,0.15);
    border-radius: 999px;
    color: var(--primary-color);
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition-smooth);
    font-size: 0.9rem;
}

.filter-btn:hover,
.filter-btn.active{
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: #fff;
    border-color: transparent;
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

/* Responsive */
@media (max-width: 1199.98px){
    .guru-grid{
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }
}

@media (max-width: 767.98px){
    .section{
        padding: 60px 0;
    }

    .section-title{
        font-size: clamp(1.5rem, 4vw, 2rem);
    }

    .guru-grid{
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .guru-photo{
        height: 250px;
    }

    .guru-body{
        padding: 20px 16px;
    }

    .guru-name{
        font-size: 1.15rem;
    }

    .guru-empty{
        padding: 40px 20px;
    }

    .guru-empty i{
        font-size: 2.5rem;
    }
}

@media (max-width: 575.98px){
    .section{
        padding: 45px 0;
    }

    .section-title{
        font-size: clamp(1.3rem, 5vw, 1.7rem);
    }

    .guru-filter{
        gap: 8px;
    }

    .filter-btn{
        padding: 8px 14px;
        font-size: 0.85rem;
    }

    .guru-photo{
        height: 200px;
    }

    .guru-body{
        padding: 16px 12px;
    }

    .guru-name{
        font-size: 1rem;
    }

    .guru-position{
        font-size: 0.95rem;
    }

    .guru-detail-item{
        font-size: 0.88rem;
        margin-bottom: 10px;
    }
}
</style>

<?php
include 'includes/navbar.php';

// Ambil data profil sekolah
$q_profil = mysqli_query($koneksi, "SELECT nama_sekolah FROM profil_sekolah WHERE id=1");
$p = mysqli_fetch_assoc($q_profil);
?>

<!-- Breadcrumb -->
<div class="breadcrumb-wrapper">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active">Data Guru</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Section -->
<section class="section">
    <div class="container">
        <div class="section-title-wrap scroll-animate">
            <div class="section-badge">
                <i class="bi bi-person-workspace"></i>
                Tim Pendidik
            </div>
            <h2 class="section-title">Data Guru & Tenaga Pendidik</h2>
            <p class="section-subtitle">
                Profil lengkap guru dan tenaga pendidik yang berdedikasi dalam membimbing dan mengembangkan potensi siswa.
            </p>
        </div>

        <?php
        // Cek apakah tabel guru ada
        $cek_tabel = mysqli_query($koneksi, "SHOW TABLES LIKE 'guru'");
        
        if (mysqli_num_rows($cek_tabel) > 0) {
            $q_guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nip ASC");
            $jumlah_guru = mysqli_num_rows($q_guru);
            
            if ($jumlah_guru > 0) {
                $guru_list = [];
                while ($g = mysqli_fetch_assoc($q_guru)) {
                    $guru_list[] = $g;
                }
                
                // Ambil data bidang unik untuk filter
                $q_bidang = mysqli_query($koneksi, "SELECT DISTINCT bidang_keahlian FROM guru WHERE bidang_keahlian IS NOT NULL AND bidang_keahlian != '' ORDER BY bidang_keahlian ASC");
        ?>
        
        <!-- Filter Section -->
        <div class="guru-filter" id="filterContainer" style="display: none;">
            <button class="filter-btn active" data-filter="all">Semua (<?= $jumlah_guru ?>)</button>
            <?php while ($bf = mysqli_fetch_assoc($q_bidang)): ?>
                <button class="filter-btn" data-filter="<?= htmlspecialchars($bf['bidang_keahlian']) ?>">
                    <?= htmlspecialchars($bf['bidang_keahlian']) ?>
                </button>
            <?php endwhile; ?>
        </div>

        <!-- Guru Grid -->
        <div class="guru-grid" id="guruGrid">
            <?php foreach ($guru_list as $index => $guru): 
                $delay_class = "delay-" . (($index % 3) + 1);
                $foto = (!empty($guru['foto']) && file_exists(__DIR__ . "/assets/img/" . $guru['foto']))
                    ? "assets/img/" . $guru['foto']
                    : "https://via.placeholder.com/400x500?text=" . urlencode($guru['nama_guru']);
            ?>
                <div class="guru-card scroll-animate <?= $delay_class ?>" data-bidang="<?= htmlspecialchars($guru['bidang_keahlian'] ?? '') ?>">
                    <div class="guru-photo">
                        <img src="<?= $foto ?>" alt="<?= htmlspecialchars($guru['nama_guru']) ?>">
                        <span class="guru-badge"><?= htmlspecialchars($guru['bidang_keahlian'] ?? 'Staff') ?></span>
                    </div>
                    <div class="guru-body">
                        <h5 class="guru-name"><?= htmlspecialchars($guru['nama_guru']) ?></h5>
                        <small class="guru-nip">NIP: <?= htmlspecialchars($guru['nip'] ?? '-') ?></small>
                        <div class="guru-position"><?= htmlspecialchars($guru['jabatan'] ?? 'Guru') ?></div>
                        
                        <div class="guru-detail">
                            <?php if (!empty($guru['no_telp'])): ?>
                                <div class="guru-detail-item">
                                    <i class="bi bi-telephone"></i>
                                    <span><?= htmlspecialchars($guru['no_telp']) ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($guru['email'])): ?>
                                <div class="guru-detail-item">
                                    <i class="bi bi-envelope"></i>
                                    <span><?= htmlspecialchars($guru['email']) ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($guru['spesialisasi'])): ?>
                                <div class="guru-detail-item">
                                    <i class="bi bi-award"></i>
                                    <span><?= htmlspecialchars($guru['spesialisasi']) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php 
            } else {
                echo '
                <div class="guru-empty">
                    <i class="bi bi-inbox"></i>
                    <h4>Belum ada data guru</h4>
                    <p>Data guru akan ditampilkan di sini setelah ditambahkan melalui admin panel.</p>
                </div>
                ';
            }
        } else {
            echo '
            <div class="guru-empty">
                <i class="bi bi-exclamation-triangle"></i>
                <h4>Tabel belum tersedia</h4>
                <p>Tabel data guru belum dibuat di database. Silakan hubungi administrator.</p>
            </div>
            ';
        }
        ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterContainer = document.getElementById('filterContainer');
    const guruGrid = document.getElementById('guruGrid');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const guruCards = document.querySelectorAll('.guru-card');
    
    // Tampilkan filter jika ada data dengan bidang keahlian
    if (guruCards.length > 0) {
        const hasBidang = Array.from(guruCards).some(card => card.getAttribute('data-bidang') !== '');
        if (hasBidang) {
            filterContainer.style.display = 'flex';
        }
    }
    
    // Filter functionality
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter cards
            let visibleCount = 0;
            guruCards.forEach((card, index) => {
                const bidang = card.getAttribute('data-bidang');
                const shouldShow = filter === 'all' || bidang === filter;
                
                if (shouldShow) {
                    card.style.display = '';
                    card.classList.add('scroll-animate');
                    card.style.animationDelay = (visibleCount * 0.12) + 's';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>

<?php
if (isset($koneksi)) {
    $q_info = mysqli_query($koneksi, "SELECT nama_sekolah, logo FROM profil_sekolah WHERE id=1");
    $d_info = mysqli_fetch_assoc($q_info);
    $nama_sekolah = $d_info ? $d_info['nama_sekolah'] : "Sekolah Purwanida";
    $logo_file = $d_info && !empty($d_info['logo']) ? $d_info['logo'] : '';
} else {
    $nama_sekolah = "Sekolah Purwanida";
    $logo_file = '';
}
?>

<style>
/* ========================
   NAVBAR MODERN REFINED
   ======================== */

.navbar{
    background: rgba(255,255,255,0.92) !important;
    padding: 0.9rem 0;
    transition: all 0.35s ease;
    border-bottom: 1px solid rgba(15,23,42,0.06);
    backdrop-filter: blur(14px);
}

.navbar.scrolled{
    background: rgba(255,255,255,0.96) !important;
    box-shadow: 0 10px 30px rgba(15,23,42,0.08);
    padding: 0.72rem 0;
}

/* ========================
   BRAND
   ======================== */

.navbar-brand{
    display: flex;
    align-items: center;
    gap: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    max-width: 420px;
}

.navbar-shell{
    padding-left: 28px;
    padding-right: 28px;
}

.navbar-brand{
    max-width: none;
}

@media (min-width: 1400px){
    .navbar-shell{
        padding-left: 42px;
        padding-right: 42px;
    }
}

@media (max-width: 767.98px){
    .navbar-shell{
        padding-left: 16px;
        padding-right: 16px;
    }
}

.brand-logo-box{
    width: 56px;
    height: 56px;
    border-radius: 18px;
    background: linear-gradient(135deg, rgba(25,135,84,0.12), rgba(32,201,151,0.10));
    border: 1px solid rgba(25,135,84,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 24px rgba(25,135,84,0.12);
    flex-shrink: 0;
    overflow: hidden;
    transition: all 0.35s ease;
}

.navbar-brand:hover .brand-logo-box{
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 14px 30px rgba(25,135,84,0.18);
}

.brand-logo-box img{
    max-width: 38px;
    max-height: 38px;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: all 0.3s ease;
}

.navbar-brand:hover .brand-logo-box img{
    transform: scale(1.06);
}

.brand-logo-box i{
    font-size: 1.6rem;
    color: #198754;
}

.brand-text{
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.15;
    min-width: 0;
}

.brand-name{
    font-size: 1.08rem;
    font-weight: 800;
    color: #14202b;
    letter-spacing: -0.3px;
    white-space: normal;
    line-height: 1.2;
}

/* ========================
   MENU
   ======================== */

.navbar-nav .nav-link{
    font-weight: 700;
    color: #334155 !important;
    margin: 0 10px;
    position: relative;
    transition: all 0.3s ease;
    padding: 0.55rem 0 !important;
    font-size: 0.96rem;
}

.navbar-nav .nav-link::after{
    content: "";
    position: absolute;
    bottom: -2px;
    left: 50%;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, #198754, #20c997);
    transition: all 0.35s ease;
    transform: translateX(-50%);
    border-radius: 999px;
}

.navbar-nav .nav-link:hover::after,
.navbar-nav .nav-link.active::after{
    width: 80%;
}

.navbar-nav .nav-link:hover{
    color: #198754 !important;
    transform: translateY(-1px);
}

/* ========================
   DROPDOWN
   ======================== */

.dropdown-menu{
    border: none;
    border-radius: 18px;
    box-shadow: 0 18px 40px rgba(15,23,42,0.14);
    padding: 10px 0;
    animation: dropdownFade 0.25s ease;
    backdrop-filter: blur(10px);
    border-top: 3px solid #198754;
    margin-top: 14px !important;
    min-width: 250px;
}

@keyframes dropdownFade{
    from{
        opacity: 0;
        transform: translateY(-10px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item{
    padding: 12px 18px;
    font-weight: 600;
    color: #334155;
    transition: all 0.25s ease;
    border-left: 3px solid transparent;
    font-size: 0.95rem;
}

.dropdown-item:hover{
    background: #f4fbf7;
    color: #198754;
    border-left-color: #198754;
    transform: translateX(4px);
}

.dropdown-item.active{
    background: rgba(25,135,84,0.08);
    color: #198754;
    border-left-color: #198754;
}

/* ========================
   LOGIN BUTTON
   ======================== */

.btn-login{
    background: linear-gradient(135deg, #198754, #20c997);
    color: white !important;
    padding: 0.68rem 1.4rem;
    border-radius: 999px;
    font-weight: 700;
    margin-left: 14px;
    box-shadow: 0 10px 24px rgba(25,135,84,0.22);
    transition: all 0.35s ease;
    border: none;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
}

.btn-login:hover{
    transform: translateY(-2px);
    box-shadow: 0 14px 30px rgba(25,135,84,0.28);
    color: white !important;
}

/* ========================
   TOGGLER
   ======================== */

.navbar-toggler{
    border: none;
    box-shadow: none;
    padding: 0.25rem;
}

.navbar-toggler:focus{
    box-shadow: none;
    outline: none;
}

.navbar-toggler-icon{
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23198754' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.3' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

/* ========================
   MOBILE
   ======================== */

@media (max-width: 991px){
    .navbar{
        padding: 0.8rem 0;
    }

    .navbar-brand{
        max-width: 78%;
    }

    .brand-logo-box{
        width: 50px;
        height: 50px;
        border-radius: 16px;
    }

    .brand-logo-box img{
        max-width: 34px;
        max-height: 34px;
    }

    .brand-name{
        font-size: 0.98rem;
    }

    .navbar-collapse{
        background: #fff;
        margin-top: 14px;
        padding: 16px 14px;
        border-radius: 18px;
        box-shadow: 0 14px 35px rgba(15,23,42,0.08);
        border: 1px solid rgba(15,23,42,0.05);
    }

    .navbar-nav{
        align-items: stretch !important;
    }

    .navbar-nav .nav-link{
        margin: 6px 0;
        padding: 0.7rem 0 !important;
    }

    .navbar-nav .nav-link::after{
        display: none;
    }

    .btn-login{
        margin-left: 0;
        margin-top: 12px;
        width: 100%;
    }
}

@media (max-width: 575.98px){
    .navbar-brand{
        gap: 10px;
    }

    .brand-logo-box{
        width: 46px;
        height: 46px;
        border-radius: 14px;
    }

    .brand-name{
        font-size: 0.9rem;
        line-height: 1.2;
    }
}
</style>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid navbar-shell">

        <a class="navbar-brand" href="index.php">
            <div class="brand-logo-box">
                <?php if(!empty($logo_file) && file_exists('assets/img/'.$logo_file)): ?>
                    <img src="assets/img/<?= htmlspecialchars($logo_file) ?>" alt="Logo Sekolah">
                <?php else: ?>
                    <i class="bi bi-mortarboard-fill"></i>
                <?php endif; ?>
            </div>

            <div class="brand-text">
                <span class="brand-name"><?= htmlspecialchars($nama_sekolah) ?></span>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button">
                        Tentang Kami
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="sejarah.php"><i class="bi bi-book me-2"></i>Sejarah Sekolah</a></li>
                        <li><a class="dropdown-item" href="komite.php"><i class="bi bi-people me-2"></i>Komite Sekolah</a></li>
                        <li><a class="dropdown-item" href="kurikulum.php"><i class="bi bi-mortarboard me-2"></i>Kurikulum</a></li>
                        <li><a class="dropdown-item" href="kesiswaan.php"><i class="bi bi-person-badge me-2"></i>Kesiswaan</a></li>
                        <li><a class="dropdown-item" href="sarpras.php"><i class="bi bi-building me-2"></i>Sarana & Prasarana</a></li>
                        <li><a class="dropdown-item" href="struktur_organisasi.php"><i class="bi bi-diagram-3 me-2"></i>Struktur Organisasi</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#berita">Berita</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#galeri">Galeri</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#ekskul">Ekstrakurikuler</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                </li>

                <li class="nav-item">
                    <a class="btn-login" href="admin/login.php">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.querySelector('.navbar');

    function toggleScrolled() {
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    toggleScrolled();
    window.addEventListener('scroll', toggleScrolled);
});
</script>
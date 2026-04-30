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
*, *::before, *::after { box-sizing: border-box; }

/* ===== BASE NAVBAR ===== */
.navbar {
    --bs-navbar-color: #475569;
    --bs-navbar-hover-color: #059669;
    --bs-navbar-active-color: #059669;
    background: rgba(255,255,255,0.85) !important;
    height: 70px;
    padding: 0;
    border-bottom: 1px solid rgba(16,185,129,0.1);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    transition: height 0.35s cubic-bezier(.4,0,.2,1),
                box-shadow 0.35s ease,
                background 0.35s ease;
    position: sticky;
    top: 0;
    z-index: 1030;
}

.navbar.scrolled {
    height: 62px;
    background: rgba(255,255,255,0.97) !important;
    box-shadow: 0 4px 32px rgba(0,0,0,0.08), 0 1px 0 rgba(0,0,0,0.04);
    border-bottom-color: transparent;
}

.navbar-shell {
    height: 100%;
    padding-left: 32px;
    padding-right: 32px;
    display: flex;
    align-items: center;
}

@media (min-width: 1400px) { .navbar-shell { padding-left: 56px; padding-right: 56px; } }
@media (max-width: 767px)  { .navbar-shell { padding-left: 16px; padding-right: 16px; } }

/* ===== BRAND ===== */
.navbar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    flex-shrink: 0;
}

.brand-logo-box {
    width: 44px;
    height: 44px;
    border-radius: 13px;
    background: linear-gradient(145deg, #ecfdf5 0%, #a7f3d0 50%, #6ee7b7 100%);
    border: 1.5px solid rgba(16,185,129,0.25);
    box-shadow: 0 2px 10px rgba(16,185,129,0.15), inset 0 1px 0 rgba(255,255,255,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
    transition: transform 0.3s cubic-bezier(.34,1.56,.64,1), box-shadow 0.3s ease;
}

.navbar-brand:hover .brand-logo-box {
    transform: translateY(-3px) scale(1.06) rotate(-2deg);
    box-shadow: 0 12px 28px rgba(16,185,129,0.25), inset 0 1px 0 rgba(255,255,255,0.6);
}

.brand-logo-box img { max-width: 28px; max-height: 28px; object-fit: contain; }
.brand-logo-box i   { font-size: 1.3rem; color: #059669; }

.brand-text  { display: flex; flex-direction: column; line-height: 1; }

.brand-name {
    font-size: 0.98rem;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.4px;
    line-height: 1.25;
    white-space: nowrap;
}

.brand-sub {
    font-size: 0.64rem;
    font-weight: 700;
    color: #10b981;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-top: 3px;
    opacity: 0.85;
}

/* ===== NAV LINKS ===== */
.navbar-nav .nav-link {
    position: relative;
    font-size: 0.875rem !important;
    font-weight: 600 !important;
    color: #64748b !important;
    padding: 7px 14px !important;
    border-radius: 999px !important;
    margin: 0 1px;
    transition: color 0.22s ease, background 0.22s ease !important;
    background: transparent !important;
    text-decoration: none !important;
    outline: none !important;
    box-shadow: none !important;
}

/* Underline pill on hover */
.navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    bottom: 4px;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: calc(100% - 28px);
    height: 2px;
    background: #10b981;
    border-radius: 2px;
    transition: transform 0.25s cubic-bezier(.4,0,.2,1);
}

/* Jangan tampilkan underline di dropdown toggle */
.navbar-nav .nav-item.dropdown .nav-link::after { display: none; }

.navbar-nav .nav-link:hover { color: #059669 !important; background: transparent !important; }
.navbar-nav .nav-link:hover::after { transform: translateX(-50%) scaleX(1); }

.navbar-nav .nav-link:focus,
.navbar-nav .nav-link:focus-visible { box-shadow: none !important; outline: none !important; }

.navbar-nav .nav-link.active,
.navbar-nav .nav-link[aria-expanded] {
    color: #64748b !important;
    background: transparent !important;
    box-shadow: none !important;
}

/* Halaman aktif */
.navbar-nav .nav-link.nav-active {
    color: #059669 !important;
    background: #f0fdf4 !important;
}

.navbar-nav .nav-link.nav-active::after { transform: translateX(-50%) scaleX(1); }

/* ===== DROPDOWN TOGGLE CARET CUSTOM ===== */
.nav-link.dropdown-toggle { padding-right: 30px !important; }

.nav-link.dropdown-toggle::before {
    content: '';
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 5px solid #94a3b8;
    transition: transform 0.22s ease, border-color 0.22s ease;
}

.nav-link.dropdown-toggle[aria-expanded="true"]::before {
    transform: translateY(-50%) rotate(180deg);
    border-top-color: #059669;
}

/* Hide Bootstrap default caret */
.dropdown-toggle::after { display: none !important; }

/* ===== DROPDOWN MENU ===== */
.dropdown-menu {
    border: 1px solid rgba(0,0,0,0.07);
    border-radius: 18px;
    box-shadow: 0 20px 48px rgba(0,0,0,0.10), 0 4px 12px rgba(0,0,0,0.05);
    padding: 8px;
    margin-top: 12px !important;
    min-width: 250px;
    animation: ddFade 0.22s cubic-bezier(.4,0,.2,1);
    background: rgba(255,255,255,0.97);
    backdrop-filter: blur(12px);
}

@keyframes ddFade {
    from { opacity:0; transform: translateY(-10px) scale(0.97); }
    to   { opacity:1; transform: translateY(0) scale(1); }
}

.dropdown-item {
    padding: 10px 14px;
    font-size: 0.875rem;
    font-weight: 600;
    color: #334155 !important;
    border-radius: 12px;
    transition: background 0.18s ease, color 0.18s ease, transform 0.18s ease;
    display: flex;
    align-items: center;
    gap: 11px;
    background: transparent !important;
}

.dropdown-item .dd-icon {
    width: 32px;
    height: 32px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    flex-shrink: 0;
    transition: transform 0.2s ease;
}

/* Warna ikon berbeda per item */
.dropdown-item:nth-child(1) .dd-icon { background:#ecfdf5; color:#10b981; }
.dropdown-item:nth-child(2) .dd-icon { background:#fef3c7; color:#d97706; }
.dropdown-item:nth-child(3) .dd-icon { background:#f0fdf4; color:#059669; }
.dropdown-item:nth-child(4) .dd-icon { background:#fdf4ff; color:#a855f7; }
.dropdown-item:nth-child(5) .dd-icon { background:#fff7ed; color:#ea580c; }
.dropdown-item:nth-child(6) .dd-icon { background:#d1fae5; color:#059669; }

.dropdown-item:hover {
    background: #f8fafc !important;
    color: #0f172a !important;
    transform: translateX(3px);
}

.dropdown-item:hover .dd-icon { transform: scale(1.12); }
.dropdown-item.active, .dropdown-item:active { background: #f0fdf4 !important; color: #059669 !important; }

/* ===== DIVIDER ===== */
.nav-divider {
    width: 1px; height: 26px;
    background: linear-gradient(to bottom, transparent, #e2e8f0, transparent);
    margin: 0 12px;
    flex-shrink: 0;
}

/* ===== LOGIN BUTTON ===== */
.btn-login {
    background: linear-gradient(135deg, #10b981, #059669) !important;
    color: #fff !important;
    padding: 9px 22px;
    border-radius: 999px;
    font-size: 0.875rem;
    font-weight: 700;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    border: none;
    box-shadow: 0 4px 14px rgba(5,150,105,0.25);
    transition: transform 0.28s cubic-bezier(.34,1.56,.64,1),
                box-shadow 0.28s ease,
                background 0.28s ease;
    white-space: nowrap;
    letter-spacing: 0.1px;
}

.btn-login:hover {
    background: linear-gradient(135deg, #059669, #047857) !important;
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 12px 28px rgba(5,150,105,0.35);
    color: #fff !important;
}

.btn-login i { font-size: 0.9rem; transition: transform 0.25s ease; }
.btn-login:hover i { transform: translateX(2px); }

/* ===== TOGGLER ===== */
.navbar-toggler {
    border: 1.5px solid rgba(16,185,129,0.2);
    border-radius: 12px;
    padding: 8px 10px;
    background: rgba(240,253,244,0.8);
    transition: background 0.2s, transform 0.2s;
}
.navbar-toggler:focus { box-shadow: none; outline: none; }
.navbar-toggler:hover { background: #d1fae5; transform: scale(1.04); }
.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23059669' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.3' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    width: 22px; height: 22px;
}

/* ===== MOBILE ===== */
@media (max-width: 991.98px) {
    .navbar { height: auto; padding: 0; }
    .navbar-shell { height: 66px; }

    .navbar-collapse {
        background: rgba(255,255,255,0.98);
        border-radius: 20px;
        border: 1px solid rgba(16,185,129,0.12);
        box-shadow: 0 20px 48px rgba(0,0,0,0.1);
        padding: 10px;
        margin: 0 10px 12px;
    }

    .navbar-nav .nav-link {
        padding: 11px 16px !important;
        margin: 2px 0;
        font-size: 0.92rem !important;
        border-radius: 12px !important;
    }

    .navbar-nav .nav-link::after { display: none; }
    .navbar-nav .nav-link:hover { background: #f0fdf4 !important; }

    .nav-divider { display: none; }

    .btn-login {
        width: 100%; margin-top: 8px;
        justify-content: center;
        padding: 13px; border-radius: 14px;
        font-size: 0.93rem;
    }

    .dropdown-menu {
        box-shadow: none;
        border: 1px solid rgba(0,0,0,0.07);
        background: #f8fafc;
        margin-top: 4px !important;
        animation: none;
    }

    .dropdown-item:hover { transform: none; }
}

@media (max-width: 575.98px) {
    .brand-logo-box { width: 40px; height: 40px; border-radius: 11px; }
    .brand-name { font-size: 0.88rem; }
    .brand-sub  { display: none; }
}
</style>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid navbar-shell">

        <a class="navbar-brand" href="index.php">
            <div class="brand-logo-box">
                <?php if(!empty($logo_file) && file_exists('assets/img/'.$logo_file)): ?>
                    <img src="assets/img/<?= htmlspecialchars($logo_file) ?>" alt="Logo">
                <?php else: ?>
                    <i class="bi bi-mortarboard-fill"></i>
                <?php endif; ?>
            </div>
            <div class="brand-text">
                <span class="brand-name"><?= htmlspecialchars($nama_sekolah) ?></span>
                <span class="brand-sub">Unggul &middot; Berkarakter</span>
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
    <li><a class="dropdown-item" href="sejarah.php">
        <span class="dd-icon"><i class="bi bi-book"></i></span>Sejarah Sekolah
    </a></li>
    <li><a class="dropdown-item" href="komite.php">
        <span class="dd-icon"><i class="bi bi-people"></i></span>Komite Sekolah
    </a></li>
    <li><a class="dropdown-item" href="kurikulum.php">
        <span class="dd-icon"><i class="bi bi-mortarboard"></i></span>Kurikulum
    </a></li>
    <li><a class="dropdown-item" href="kesiswaan.php">
        <span class="dd-icon"><i class="bi bi-person-badge"></i></span>Kesiswaan
    </a></li>
    <li><a class="dropdown-item" href="sarpras.php">
        <span class="dd-icon"><i class="bi bi-building"></i></span>Sarana & Prasarana
    </a></li>
    <li><a class="dropdown-item" href="guru.php">
        <span class="dd-icon"><i class="bi bi-person-workspace"></i></span>Data Guru
    </a></li>
    <li><a class="dropdown-item" href="struktur_organisasi.php">
        <span class="dd-icon"><i class="bi bi-diagram-3"></i></span>Struktur Organisasi
    </a></li>
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

                <li class="nav-item d-none d-lg-flex align-items-center">
                    <div class="nav-divider"></div>
                </li>

                <li class="nav-item">
                    <a class="btn-login" href="admin/login.php">
                        <i class="bi bi-box-arrow-in-right"></i>Login
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.querySelector('.navbar');

    // Scroll effect
    function handleScroll() {
        navbar.classList.toggle('scrolled', window.scrollY > 20);
    }
    handleScroll();
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Reset semua active Bootstrap — jalankan setelah DOM siap
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.classList.remove('active');
        link.removeAttribute('aria-current');
    });

    // Set active hanya untuk halaman yang benar-benar cocok
    const currentPage = location.pathname.split('/').pop() || 'index.php';
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        const href = link.getAttribute('href');
        // Cocokkan exact — bukan contains, supaya index.php#berita tidak ikut aktif
        if (href && href === currentPage) {
            link.classList.add('nav-active');
        }
    });
});
</script>
<?php
// Reusable admin sidebar used by custom admin editor pages
?>
<style>
:root {
    --bg-main: #f8fafc;
    --bg-sidebar: #053b29;
    --bg-sidebar-active: #085138;
    --primary-green: #066943;
    --light-green: #e9f5f0;
    --text-dark: #1e293b;
    --text-muted: #64748b;
}

body {
    font-family: 'Poppins', sans-serif;
    background: var(--bg-main) !important;
    color: var(--text-dark) !important;
}

body .bg-dark {
    background-color: var(--bg-main) !important;
}

body .text-white {
    color: var(--text-dark) !important;
}

body .text-muted {
    color: var(--text-muted) !important;
}

body .card,
body .card-custom,
body .stat-card,
body .modal-content {
    background: #ffffff !important;
    color: var(--text-dark) !important;
    border-color: rgba(226,232,240,0.75) !important;
}

body .form-control {
    background: #f8fafc !important;
    border: 1px solid #cbd5e1 !important;
    color: var(--text-dark) !important;
}

body .form-control:focus {
    background: #ffffff !important;
    border-color: #a7f3d0 !important;
    box-shadow: 0 0 0 0.15rem rgba(16,185,129,0.25) !important;
}

body .btn-primary {
    background-color: var(--primary-green) !important;
    border-color: var(--primary-green) !important;
}

body .btn-secondary {
    background-color: #f1f5f9 !important;
    color: var(--text-dark) !important;
    border-color: #cbd5e1 !important;
}

body .badge {
    color: var(--text-dark) !important;
}

body .table-dark-custom {
    background-color: #ffffff !important;
}

body .table-dark-custom th,
body .table-dark-custom td {
    color: var(--text-dark) !important;
}

body .sidebar-wrapper {
    width: 260px;
    background: var(--bg-sidebar);
    height: 100vh;
    max-height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease-in-out;
    z-index: 1050;
    overflow: hidden;
}

body .sidebar-brand {
    padding: 25px 20px;
    color: white;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
}

body .sidebar-brand .logo-icon {
    background: #10b981;
    padding: 8px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

body .sidebar-nav {
    flex: 1 1 auto;
    min-height: 0;
    overflow-y: auto;
    overflow-x: hidden;
    padding-bottom: 20px;
}

body .sidebar-nav .nav-link {
    padding: 12px 15px !important;
    gap: 0 !important;
}

body .sidebar-nav::-webkit-scrollbar {
    width: 5px;
}
body .sidebar-nav::-webkit-scrollbar-track {
    background: transparent;
}
body .sidebar-nav::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.15);
    border-radius: 10px;
}
body .sidebar-nav::-webkit-scrollbar-thumb:hover {
    background: rgba(255,255,255,0.3);
}

body .sidebar-nav .nav-link i {
    width: 24px !important;
    min-width: 24px !important;
    max-width: 24px !important;
    text-align: center !important;
    margin-right: 10px;
    flex-shrink: 0;
    font-size: 1rem !important;
}

body .nav-link {
    color: #cbd5e1 !important;
    border-radius: 8px;
    padding: 12px 15px;
    margin-bottom: 5px;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: 0.2s;
}

body .nav-link:hover,
body .nav-link.active {
    background: var(--bg-sidebar-active) !important;
    color: white !important;
}

body .sidebar-profile {
    padding: 20px;
    border-top: 1px solid rgba(255,255,255,0.05);
    background: var(--bg-sidebar);
    flex-shrink: 0;
}

body .btn-logout {
    background: #10b981 !important;
    color: white !important;
    font-weight: 500;
    border: none;
}

body .btn-logout:hover {
    background: #059669 !important;
}

.sidebar-wrapper + .flex-grow-1,
.sidebar-wrapper + .main-content {
    margin-left: 260px;
    transition: margin-left 0.3s ease-in-out;
}

.main-content {
    padding: 30px;
    min-height: 100vh;
}

/* --- Styling Responsif (Mobile & Tablet) --- */
@media (max-width: 991.98px) {
    body .sidebar-wrapper {
        transform: translateX(-100%);
    }
    
    body .sidebar-wrapper.show {
        transform: translateX(0);
    }

    .sidebar-wrapper + .flex-grow-1,
    .sidebar-wrapper + .main-content {
        margin-left: 0 !important;
    }

    .mobile-toggle-btn {
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1040;
        background: var(--primary-green);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        cursor: pointer;
    }
}

.sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1045;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s ease-in-out;
}
.sidebar-overlay.show {
    opacity: 1;
    visibility: visible;
}
</style>

<button class="mobile-toggle-btn d-lg-none" onclick="toggleSidebar()">
    <i class="bi bi-list fs-4"></i>
</button>

<div class="sidebar-overlay d-lg-none" onclick="toggleSidebar()"></div>

<div class="sidebar-wrapper d-flex flex-column" id="adminSidebar">
    <div class="sidebar-brand">
        <div class="logo-icon">
            <i class="bi bi-mortarboard-fill text-white fs-5"></i>
        </div>
        <div>
            <div class="fw-bold" style="font-size: 16px; line-height: 1.2;">Bina Karya<br>Kreatif</div>
            <div style="font-size: 10px; color: #10b981; font-weight: 600; letter-spacing: 1px;">ADMIN PANEL</div>
        </div>
        <button class="btn btn-link text-white ms-auto d-lg-none" onclick="toggleSidebar()" style="text-decoration:none;">
            <i class="bi bi-x-lg fs-5"></i>
        </button>
    </div>

    <div class="sidebar-nav mt-2">
        <ul class="nav flex-column ps-0">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="bi bi-grid-fill fs-5 w-20px text-center"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="berita.php">
                    <i class="bi bi-file-earmark-text fs-5 w-20px text-center"></i> Kelola Berita
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="galeri.php">
                    <i class="bi bi-images w-20px text-center"></i> Kelola Galeri
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ekskul.php">
                    <i class="bi bi-people-fill fs-5 w-20px text-center"></i> Ekstrakurikuler
                </a>
            </li>

            <li class="nav-item mt-2">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#pengaturanCollapse" role="button" aria-expanded="false" aria-controls="pengaturanCollapse">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-gear-fill fs-5 w-20px text-center"></i> Pengaturan
                    </div>
                    <i class="bi bi-caret-down-fill" style="font-size: 12px;"></i>
                </a>
                
                <?php
                $active = basename($_SERVER['PHP_SELF']);
                $openPages = ['pengaturan.php','sejarah.php','komite.php','kurikulum.php','kesiswaan.php','sarpras.php','struktur_organisasi.php'];
                $collapseClass = in_array($active, $openPages) ? 'collapse ps-3 show' : 'collapse ps-3';
                ?>
                
                <div class="<?= $collapseClass ?>" id="pengaturanCollapse">
                    <ul class="nav flex-column mt-1 mb-2" style="border-left: 1px solid rgba(255,255,255,0.1); margin-left: 12px; padding-left: 5px;">
                        <li class="nav-item"><a class="nav-link" style="font-size: 13px; padding: 6px 15px;" href="pengaturan.php">Pengaturan Website</a></li>
                        <li class="nav-item"><a class="nav-link" style="font-size: 13px; padding: 6px 15px;" href="sejarah.php">Sejarah Sekolah</a></li>
                        <li class="nav-item"><a class="nav-link" style="font-size: 13px; padding: 6px 15px;" href="komite.php">Komite Sekolah</a></li>
                        <li class="nav-item"><a class="nav-link" style="font-size: 13px; padding: 6px 15px;" href="kurikulum.php">Kurikulum</a></li>
                        <li class="nav-item"><a class="nav-link" style="font-size: 13px; padding: 6px 15px;" href="kesiswaan.php">Kesiswaan</a></li>
                        <li class="nav-item"><a class="nav-link" style="font-size: 13px; padding: 6px 15px;" href="sarpras.php">Sarana &amp; Prasarana</a></li>
                        <li class="nav-item"><a class="nav-link" style="font-size: 13px; padding: 6px 15px;" href="struktur_organisasi.php">Struktur Organisasi</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <div class="sidebar-profile mt-auto">
        <div class="d-flex align-items-center mb-3">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" width="40" height="40" alt="Avatar">
            <div>
                <div class="fw-bold text-white" style="font-size: 13px;">Administrator</div>
                <div style="font-size: 11px; color: #10b981;">Super Admin</div>
            </div>
        </div>
        <a href="logout.php" class="btn btn-logout w-100 rounded-2 d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<script>
// Fungsi untuk Toggle Sidebar (Mobile)
function toggleSidebar() {
    document.getElementById('adminSidebar').classList.toggle('show');
    document.querySelector('.sidebar-overlay').classList.toggle('show');
}

// Sidebar active link & collapse auto-open
document.addEventListener('DOMContentLoaded', function(){
    var path = window.location.pathname.split('/').pop();
    if(!path || path === '') path = 'dashboard.php';
    
    var links = document.querySelectorAll('.sidebar-nav a.nav-link');
    links.forEach(function(link) {
        if(link.getAttribute('href').toLowerCase() === path.toLowerCase()){
            link.classList.add('active');
            
            // Buka dropdown jika link ada di dalam submenu
            var collapseDiv = link.closest('.collapse');
            if(collapseDiv && typeof bootstrap !== 'undefined'){
                new bootstrap.Collapse(collapseDiv, {toggle: false}).show();
            }
        }
    });
});
</script>
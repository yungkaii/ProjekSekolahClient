<?php
// retrieve contact info for footer (queried every time include loaded)
$contact = [];
if(isset($koneksi)){
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
        $contact = [];
    }
}

// Parse jam_operasional into rows (format: "Senin - Kamis: 07:00 - 15:30\nJumat: 07:00 - 14:00")
$jam_rows = [];
if(!empty($contact['jam_operasional'])){
    $lines = preg_split('/\r\n|\r|\n|,/', $contact['jam_operasional']);
    foreach($lines as $line){
        $line = trim($line);
        if(!$line) continue;
        if(strpos($line, ':') !== false){
            $parts = explode(':', $line, 2);
            $jam_rows[] = ['hari' => trim($parts[0]), 'jam' => trim($parts[1])];
        } else {
            $jam_rows[] = ['hari' => $line, 'jam' => ''];
        }
    }
}
?>

<style>
    .footer-v2 {
        background: linear-gradient(160deg, #0b1a12 0%, #0f2318 50%, #0d1f10 100%);
        color: #c8d8c9;
        font-family: 'DM Sans', 'Segoe UI', sans-serif;
        padding: 56px 0 0;
        position: relative;
        overflow: hidden;
    }

    /* subtle texture overlay */
    .footer-v2::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle at 20% 20%, rgba(34,197,94,0.06) 0%, transparent 50%),
                          radial-gradient(circle at 80% 80%, rgba(21,128,61,0.05) 0%, transparent 50%);
        pointer-events: none;
    }

    .footer-v2 .container { position: relative; z-index: 1; }

    /* ── Column headings ── */
    .footer-v2 .fcol-title {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #4ade80;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(74,222,128,0.18);
    }

    /* ── Col 1: School name ── */
    .footer-v2 .school-name {
        font-size: 18px;
        font-weight: 700;
        color: #f0fdf4;
        line-height: 1.3;
        margin-bottom: 12px;
    }
    .footer-v2 .school-addr {
        font-size: 13px;
        color: #86a98a;
        line-height: 1.7;
        margin-bottom: 20px;
    }

    /* Social icons */
    .footer-v2 .social-wrap { display: flex; gap: 10px; }
    .footer-v2 .social-btn {
        width: 34px; height: 34px;
        border-radius: 50%;
        border: 1px solid rgba(74,222,128,0.3);
        display: inline-flex; align-items: center; justify-content: center;
        color: #86a98a;
        font-size: 15px;
        text-decoration: none;
        transition: background 0.2s, color 0.2s, border-color 0.2s, transform 0.2s;
    }
    .footer-v2 .social-btn:hover {
        background: #4ade80;
        border-color: #4ade80;
        color: #0b1a12;
        transform: translateY(-3px);
    }

    /* ── Col 2: Contact ── */
    .footer-v2 .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 14px;
        font-size: 13.5px;
        color: #a5c2a7;
        line-height: 1.5;
    }
    .footer-v2 .contact-item .ci-icon {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: rgba(74,222,128,0.1);
        border: 1px solid rgba(74,222,128,0.2);
        display: inline-flex; align-items: center; justify-content: center;
        color: #4ade80;
        font-size: 13px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* ── Col 3: Hours ── */
    .footer-v2 .hours-table { width: 100%; border-collapse: collapse; }
    .footer-v2 .hours-table tr td {
        font-size: 13px;
        color: #a5c2a7;
        padding: 4px 0;
        vertical-align: top;
    }
    .footer-v2 .hours-table tr td:first-child {
        padding-right: 18px;
        white-space: nowrap;
    }
    .footer-v2 .hours-table tr td:last-child {
        color: #c8d8c9;
        font-weight: 500;
    }
    .footer-v2 .hours-table tr.closed td { color: #6b7b6c; font-style: italic; }

    /* ── Col 4: Map ── */
    .footer-v2 .map-wrap {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(74,222,128,0.15);
        margin-bottom: 12px;
        height: 130px;
    }
    .footer-v2 .map-wrap iframe {
        width: 100%; height: 100%;
        border: none; display: block;
        border-radius: 12px;
    }
    .footer-v2 .btn-maps {
        display: block;
        width: 100%;
        text-align: center;
        padding: 9px;
        border-radius: 8px;
        border: 1px solid rgba(74,222,128,0.3);
        background: rgba(74,222,128,0.06);
        color: #4ade80;
        font-size: 12.5px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        text-decoration: none;
        transition: background 0.2s, border-color 0.2s;
    }
    .footer-v2 .btn-maps:hover {
        background: rgba(74,222,128,0.15);
        border-color: #4ade80;
    }

    /* ── Bottom bar ── */
    .footer-v2 .footer-bottom {
        margin-top: 48px;
        border-top: 1px solid rgba(255,255,255,0.05);
        padding: 18px 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .footer-v2 .footer-bottom .copy {
        font-size: 12px;
        color: #4a5e4b;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .footer-v2 .footer-bottom .bottom-links {
        display: flex;
        gap: 24px;
    }
    .footer-v2 .footer-bottom .bottom-links a {
        font-size: 12px;
        color: #4a5e4b;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: color 0.2s;
    }
    .footer-v2 .footer-bottom .bottom-links a:hover { color: #4ade80; }

    @media(max-width: 767px){
        .footer-v2 .footer-bottom { flex-direction: column; text-align: center; }
        .footer-v2 .footer-bottom .bottom-links { justify-content: center; }
    }
</style>

<footer id="kontak" class="footer-v2">
    <div class="container">
        <div class="row g-5">

            <!-- Col 1: School Identity -->
            <div class="col-md-3">
                <div class="school-name">
                    <?= htmlspecialchars($contact['nama_sekolah'] ?? 'Bina Karya Kreatif') ?>
                </div>
                <div class="school-addr">
                    <?= nl2br(htmlspecialchars($contact['alamat'] ?? '')) ?>
                </div>
                <div class="social-wrap">
                    <?php if(!empty($contact['facebook'])): ?>
                        <a href="<?= htmlspecialchars($contact['facebook']) ?>" class="social-btn" target="_blank">
                            <i class="bi bi-facebook"></i>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($contact['instagram'])): ?>
                        <a href="<?= htmlspecialchars($contact['instagram']) ?>" class="social-btn" target="_blank">
                            <i class="bi bi-instagram"></i>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($contact['youtube'])): ?>
                        <a href="<?= htmlspecialchars($contact['youtube']) ?>" class="social-btn" target="_blank">
                            <i class="bi bi-youtube"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Col 2: Contact -->
            <div class="col-md-3">
                <div class="fcol-title">Kontak Kami</div>

                <?php if(!empty($contact['alamat'])): ?>
                <div class="contact-item">
                    <span class="ci-icon"><i class="bi bi-geo-alt-fill"></i></span>
                    <span><?= htmlspecialchars($contact['alamat']) ?></span>
                </div>
                <?php endif; ?>

                <?php if(!empty($contact['telepon'])): ?>
                <div class="contact-item">
                    <span class="ci-icon"><i class="bi bi-telephone-fill"></i></span>
                    <span><?= htmlspecialchars($contact['telepon']) ?></span>
                </div>
                <?php endif; ?>

                <?php if(!empty($contact['email'])): ?>
                <div class="contact-item">
                    <span class="ci-icon"><i class="bi bi-envelope-fill"></i></span>
                    <span><?= htmlspecialchars($contact['email']) ?></span>
                </div>
                <?php endif; ?>
            </div>

            <!-- Col 3: Operating Hours -->
            <div class="col-md-3">
                <div class="fcol-title">Jam Operasional</div>
                <?php if(!empty($jam_rows)): ?>
                    <table class="hours-table">
                        <?php foreach($jam_rows as $row): ?>
                            <?php $is_closed = stripos($row['jam'], 'tutup') !== false || stripos($row['hari'], 'tutup') !== false; ?>
                            <tr class="<?= $is_closed ? 'closed' : '' ?>">
                                <td><?= htmlspecialchars($row['hari']) ?></td>
                                <td><?= $row['jam'] ? htmlspecialchars($row['jam']) : '<em>Tutup</em>' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php elseif(!empty($contact['jam_operasional'])): ?>
                    <p style="font-size:13px;color:#a5c2a7;">
                        <?= nl2br(htmlspecialchars($contact['jam_operasional'])) ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Col 4: Map -->
            <div class="col-md-3">
                <div class="fcol-title">Lokasi</div>
                <?php if(!empty($contact['map_embed'])): ?>
                    <div class="map-wrap">
                        <?= $contact['map_embed'] ?>
                    </div>
                    <a href="https://maps.google.com?q=<?= urlencode($contact['alamat'] ?? '') ?>" target="_blank" class="btn-maps">
                        Buka Google Maps
                    </a>
                <?php else: ?>
                    <div style="font-size:13px;color:#4a5e4b;font-style:italic;">Embed peta belum dikonfigurasi.</div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <span class="copy">
                © <?= date('Y') ?> <?= htmlspecialchars($contact['nama_sekolah'] ?? 'Bina Karya Kreatif') ?>. All Rights Reserved.
            </span>
            <div class="bottom-links">
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat &amp; Ketentuan</a>
                <a href="index.php#kontak">Hubungi Kami</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
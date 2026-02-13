<?php
session_start();
include '../config/koneksi.php';

// Ambil data profil saat ini (ID 1)
$query = mysqli_query($koneksi, "SELECT * FROM profil_sekolah WHERE id=1");
$data  = mysqli_fetch_assoc($query);

// Jika data kosong (pertama kali), buat dummy data agar tidak error
if(!$data){
    mysqli_query($koneksi, "INSERT INTO profil_sekolah (id, nama_sekolah, deskripsi_hero) VALUES (1, 'Sekolah Kita', 'Deskripsi sekolah...')");
    echo "<meta http-equiv='refresh' content='0'>"; // Refresh halaman
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengaturan Profil Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container col-md-8">
        <div class="d-flex justify-content-between mb-3">
            <h3>Pengaturan Website</h3>
            <a href="index.php" class="btn btn-secondary">Kembali Dashboard</a>
        </div>

        <div class="card shadow">
            <div class="card-header bg-primary text-white fw-bold">Edit Profil & Banner</div>
            <div class="card-body">
                <form action="proses.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="1">
                    
                    <div class="mb-3">
                        <label class="fw-bold">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" class="form-control" value="<?= $data['nama_sekolah'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Deskripsi Banner (Hero Text)</label>
                        <textarea name="deskripsi_hero" class="form-control" rows="3"><?= $data['deskripsi_hero'] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Banner / Background Utama</label><br>
                        <?php if(!empty($data['gambar_hero'])): ?>
                            <img src="../assets/img_sekolah/<?= $data['gambar_hero'] ?>" class="mb-2 rounded" width="100%" style="max-height: 200px; object-fit: cover;">
                            <br><small class="text-muted">Gambar saat ini</small>
                        <?php else: ?>
                            <small class="text-danger">Belum ada banner diupload.</small>
                        <?php endif; ?>
                        
                        <input type="file" name="foto_hero" class="form-control mt-2" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti banner.</small>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Isi Sambutan / Profil Singkat</label>
                        <textarea name="isi_profil" class="form-control" rows="5"><?= $data['isi_profil'] ?? '' ?></textarea>
                    </div>

                    <button type="submit" name="update_profil" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
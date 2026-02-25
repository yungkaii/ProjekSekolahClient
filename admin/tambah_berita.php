<?php include '../config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white fw-bold">Tambah Berita Baru</div>
            <div class="card-body">
                <form action="proses.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Judul Berita</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Foto</label>
                        <input type="file" name="foto_berita" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label>Isi Berita</label>
                        <textarea name="isi" class="form-control" rows="6" required></textarea>
                    </div>
                    <button type="submit" name="simpan_berita" class="btn btn-success">Simpan</button>
                    <a href="berita.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
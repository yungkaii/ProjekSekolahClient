<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5 col-md-6">
    <div class="card">
        <div class="card-header">Upload Foto Galeri</div>
        <div class="card-body">
            <form action="proses.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="judul" class="form-control mb-3" placeholder="Judul Kegiatan" required>
                <input type="file" name="foto" class="form-control mb-3" required>
                <button type="submit" name="upload_galeri" class="btn btn-success w-100">Upload</button>
                <a href="galeri.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
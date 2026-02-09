<?php
session_start();
include '../config/koneksi.php';

// ==========================================================
// 1. LOGIK LOGIN (INI YANG KEMARIN HILANG)
// ==========================================================
if(isset($_POST['login'])){
    // Ambil data dari form login
    $user = mysqli_real_escape_string($koneksi, $_POST['user']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['pass']);

    // Cek ke database (Sesuaikan nama tabel user kamu, biasanya 'pengguna' atau 'admin')
    // Asumsi password menggunakan MD5, jika tidak pakai MD5, hapus fungsi md5()
    $cek = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE username = '".$user."' AND password = '".md5($pass)."'");

    if(mysqli_num_rows($cek) > 0){
        $d = mysqli_fetch_object($cek);
        $_SESSION['status_login'] = true;
        $_SESSION['a_global'] = $d;
        $_SESSION['id'] = $d->id;
        
        echo "<script>window.location='dashboard.php'</script>";
    }else{
        echo "<script>alert('Username atau Password Salah!');window.location='login.php'</script>";
    }
}

// ==========================================================
// 2. KELOLA PENGATURAN / IDENTITAS SEKOLAH
// ==========================================================
if(isset($_POST['update_profil'])){ // Pastikan tombol di pengaturan.php namanya 'update_profil'
    $id = $_POST['id']; // Pastikan ada input hidden id di pengaturan.php
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $gmaps = mysqli_real_escape_string($koneksi, $_POST['gmaps']);

    // Update Logo Jika Ada
    if($_FILES['logo']['name'] != ""){
        $foto = $_FILES['logo']['name'];
        $tmp = $_FILES['logo']['tmp_name'];
        $nama_baru = "logo_".time().$foto;
        $path = "../assets/img/".$nama_baru;
        
        // Hapus logo lama
        $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM identitas WHERE id='$id'"));
        if(file_exists("../assets/img/".$data['logo_sekolah'])){
            unlink("../assets/img/".$data['logo_sekolah']);
        }
        move_uploaded_file($tmp, $path);
        
        $query = "UPDATE identitas SET nama_sekolah='$nama', email_sekolah='$email', telepon_sekolah='$telp', alamat_sekolah='$alamat', google_maps='$gmaps', logo_sekolah='$nama_baru' WHERE id='$id'";
    } else {
        $query = "UPDATE identitas SET nama_sekolah='$nama', email_sekolah='$email', telepon_sekolah='$telp', alamat_sekolah='$alamat', google_maps='$gmaps' WHERE id='$id'";
    }

    $update = mysqli_query($koneksi, $query);
    if($update){
        echo "<script>alert('Pengaturan Berhasil Diubah'); window.location='pengaturan.php';</script>";
    } else {
        echo "<script>alert('Gagal Mengubah Pengaturan'); window.location='pengaturan.php';</script>";
    }
}

// ==========================================================
// 3. KELOLA BERITA
// ==========================================================
if(isset($_POST['simpan_berita'])){
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $tanggal = date('Y-m-d'); 
    
    $foto = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $nama_baru = date('dmYHis') . "_" . $foto;
    $path = "../assets/img_berita/" . $nama_baru;

    if(move_uploaded_file($tmp, $path)){
        mysqli_query($koneksi, "INSERT INTO berita (judul, tanggal, gambar) VALUES ('$judul', '$tanggal', '$nama_baru')");
        echo "<script>alert('Berita Berhasil Ditambahkan'); window.location='berita.php';</script>";
    }
}

if(isset($_POST['update_berita'])){
    $id = $_POST['id'];
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    
    if($_FILES['gambar']['name'] != ""){
        $foto = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $nama_baru = date('dmYHis') . "_" . $foto;
        $path = "../assets/img_berita/" . $nama_baru;
        
        $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM berita WHERE id='$id'"));
        if(file_exists("../assets/img_berita/" . $data['gambar'])){
            unlink("../assets/img_berita/" . $data['gambar']);
        }
        move_uploaded_file($tmp, $path);
        $query = "UPDATE berita SET judul='$judul', gambar='$nama_baru' WHERE id='$id'";
    } else {
        $query = "UPDATE berita SET judul='$judul' WHERE id='$id'";
    }
    mysqli_query($koneksi, $query);
    echo "<script>alert('Berita Berhasil Diupdate'); window.location='berita.php';</script>";
}

if(isset($_GET['hapus_berita'])){
    $id = $_GET['hapus_berita'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM berita WHERE id='$id'"));
    if(file_exists("../assets/img_berita/" . $data['gambar'])){
        unlink("../assets/img_berita/" . $data['gambar']);
    }
    mysqli_query($koneksi, "DELETE FROM berita WHERE id='$id'");
    echo "<script>alert('Berita Berhasil Dihapus'); window.location='berita.php';</script>";
}

// ==========================================================
// 4. KELOLA GALERI
// ==========================================================
if(isset($_POST['simpan_galeri'])){
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $nama_baru = date('dmYHis') . "_" . $foto;
    $path = "../assets/img/" . $nama_baru;

    if(move_uploaded_file($tmp, $path)){
        mysqli_query($koneksi, "INSERT INTO galeri (keterangan, foto) VALUES ('$keterangan', '$nama_baru')");
        echo "<script>alert('Foto Galeri Berhasil Ditambahkan'); window.location='galeri.php';</script>";
    }
}

if(isset($_GET['hapus_galeri'])){
    $id = $_GET['hapus_galeri'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM galeri WHERE id='$id'"));
    if(file_exists("../assets/img/" . $data['foto'])){
        unlink("../assets/img/" . $data['foto']);
    }
    mysqli_query($koneksi, "DELETE FROM galeri WHERE id='$id'");
    echo "<script>alert('Galeri Berhasil Dihapus'); window.location='galeri.php';</script>";
}

// ==========================================================
// 5. KELOLA EKSTRAKURIKULER
// ==========================================================
if(isset($_POST['simpan_ekskul'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $foto = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $nama_baru = date('dmYHis') . "_" . $foto;
    $path = "../assets/img_ekskul/" . $nama_baru;

    if(move_uploaded_file($tmp, $path)){
        mysqli_query($koneksi, "INSERT INTO ekstrakurikuler (nama_ekskul, gambar) VALUES ('$nama', '$nama_baru')");
        echo "<script>alert('Ekskul Berhasil Ditambahkan'); window.location='ekskul.php';</script>";
    }
}

if(isset($_GET['hapus_ekskul'])){
    $id = $_GET['hapus_ekskul'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler WHERE id='$id'"));
    if(file_exists("../assets/img_ekskul/" . $data['gambar'])){
        unlink("../assets/img_ekskul/" . $data['gambar']);
    }
    mysqli_query($koneksi, "DELETE FROM ekstrakurikuler WHERE id='$id'");
    echo "<script>alert('Ekskul Berhasil Dihapus'); window.location='ekskul.php';</script>";
}

if(isset($_POST['update_ekskul'])){
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    if($_FILES['gambar']['name'] != ""){
        $foto = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $nama_baru = date('dmYHis') . "_" . $foto;
        $path = "../assets/img_ekskul/" . $nama_baru;
        
        $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ekstrakurikuler WHERE id='$id'"));
        if(file_exists("../assets/img_ekskul/" . $data['gambar'])){
            unlink("../assets/img_ekskul/" . $data['gambar']);
        }
        move_uploaded_file($tmp, $path);
        $query = "UPDATE ekstrakurikuler SET nama_ekskul='$nama', gambar='$nama_baru' WHERE id='$id'";
    } else {
        $query = "UPDATE ekstrakurikuler SET nama_ekskul='$nama' WHERE id='$id'";
    }
    mysqli_query($koneksi, $query);
    echo "<script>alert('Data Berhasil Diupdate'); window.location='ekskul.php';</script>";
}

?>
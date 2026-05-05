<?php
session_start();
include '../config/koneksi.php';

// Function untuk log notifikasi
function logNotifikasi($koneksi, $tipe, $aksi, $judul, $link = 'dashboard.php'){
    $tipe = mysqli_real_escape_string($koneksi, $tipe);
    $aksi = mysqli_real_escape_string($koneksi, $aksi);
    $judul = mysqli_real_escape_string($koneksi, $judul);
    $link = mysqli_real_escape_string($koneksi, $link);
    
    $query = "INSERT INTO notifikasi (tipe, aksi, judul, link, created_at) VALUES ('$tipe', '$aksi', '$judul', '$link', NOW())";
    return mysqli_query($koneksi, $query);
}

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
// 2. KELOLA PENGATURAN SEKOLAH (profil_sekolah)
// ==========================================================
if(isset($_POST['update_profil'])){
    $id = $_POST['id'];
    // contact/social fields may not exist yet; add if missing
    $cols = ['alamat','telepon','email','jam_operasional','facebook','instagram','youtube','map_embed','visi','misi'];
    foreach($cols as $col){
        $check = mysqli_query($koneksi, "SHOW COLUMNS FROM profil_sekolah LIKE '$col'");
        if(mysqli_num_rows($check) == 0){
            mysqli_query($koneksi, "ALTER TABLE profil_sekolah ADD COLUMN $col TEXT NULL");
        }
    }

    // fetch existing row for conditional updates
    $oldData = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM profil_sekolah WHERE id='$id'"));

    $nama        = mysqli_real_escape_string($koneksi, $_POST['nama_sekolah']);
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi_hero']);
    $isi_profil  = mysqli_real_escape_string($koneksi, $_POST['isi_profil']);
    $keunggulan1 = mysqli_real_escape_string($koneksi, $_POST['keunggulan_1']);
    $keunggulan2 = mysqli_real_escape_string($koneksi, $_POST['keunggulan_2']);
    $keunggulan3 = mysqli_real_escape_string($koneksi, $_POST['keunggulan_3']);
    // new visi/misi fields
    $visi        = mysqli_real_escape_string($koneksi, $_POST['visi'] ?? '');
    $misi        = mysqli_real_escape_string($koneksi, $_POST['misi'] ?? '');

    // sanitize contact values (allow empty)
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telepon       = mysqli_real_escape_string($koneksi, $_POST['telepon']);
    $email         = mysqli_real_escape_string($koneksi, $_POST['email']);
    $jam_operasional = mysqli_real_escape_string($koneksi, $_POST['jam_operasional']);
    $facebook      = mysqli_real_escape_string($koneksi, $_POST['facebook']);
    $instagram     = mysqli_real_escape_string($koneksi, $_POST['instagram']);
    $youtube       = mysqli_real_escape_string($koneksi, $_POST['youtube']);
    $map_embed     = mysqli_real_escape_string($koneksi, $_POST['map_embed']);

    // prepare parts of query
    $fields = [];
    $fields[] = "nama_sekolah='$nama'";
    $fields[] = "deskripsi_hero='$deskripsi'";
    $fields[] = "isi_profil='$isi_profil'";
    // add visi/misi if provided or existing value
    if($visi !== '' || !empty($oldData['visi'])){
        $fields[] = "visi='$visi'";
    }
    if($misi !== '' || !empty($oldData['misi'])){
        $fields[] = "misi='$misi'";
    }
    $fields[] = "keunggulan_1='$keunggulan1'";
    $fields[] = "keunggulan_2='$keunggulan2'";
    $fields[] = "keunggulan_3='$keunggulan3'";
    // include contact/social only when provided or existing value present
    if($alamat !== '' || !empty($oldData['alamat'])){
        $fields[] = "alamat='$alamat'";
    }
    if($telepon !== '' || !empty($oldData['telepon'])){
        $fields[] = "telepon='$telepon'";
    }
    if($email !== '' || !empty($oldData['email'])){
        $fields[] = "email='$email'";
    }
    if($jam_operasional !== '' || !empty($oldData['jam_operasional'])){
        $fields[] = "jam_operasional='$jam_operasional'";
    }
    if($facebook !== '' || !empty($oldData['facebook'])){
        $fields[] = "facebook='$facebook'";
    }
    if($instagram !== '' || !empty($oldData['instagram'])){
        $fields[] = "instagram='$instagram'";
    }
    if($youtube !== '' || !empty($oldData['youtube'])){
        $fields[] = "youtube='$youtube'";
    }
    if($map_embed !== '' || !empty($oldData['map_embed'])){
        $fields[] = "map_embed='$map_embed'";
    }

    // handle logo upload for navbar
    if(isset($_FILES['logo']) && $_FILES['logo']['name'] != ""){
        $foto = $_FILES['logo']['name'];
        $tmp  = $_FILES['logo']['tmp_name'];
        $nama_baru = "logo_".time()."_".$foto;
        $path = "../assets/img/" . $nama_baru;
        $old = mysqli_fetch_array(mysqli_query($koneksi, "SELECT logo FROM profil_sekolah WHERE id='$id'"));
        if(!empty($old['logo']) && file_exists("../assets/img/".$old['logo'])){
            unlink("../assets/img/".$old['logo']);
        }
        if(move_uploaded_file($tmp, $path)){
            $fields[] = "logo='$nama_baru'";
        }
    }

    // handle hero image
    if(isset($_FILES['foto_hero']) && $_FILES['foto_hero']['name'] != ""){
        $foto = $_FILES['foto_hero']['name'];
        $tmp  = $_FILES['foto_hero']['tmp_name'];
        $nama_baru = "hero_".time()."_".$foto;
        $path = "../assets/img_sekolah/" . $nama_baru;
        // remove previous file if exists
        $old = mysqli_fetch_array(mysqli_query($koneksi, "SELECT gambar_hero FROM profil_sekolah WHERE id='$id'"));
        if(!empty($old['gambar_hero']) && file_exists("../assets/img_sekolah/".$old['gambar_hero'])){
            unlink("../assets/img_sekolah/".$old['gambar_hero']);
        }
        if(move_uploaded_file($tmp, $path)){
            $fields[] = "gambar_hero='$nama_baru'";
        }
    }

    // handle profil picture
    if(isset($_FILES['foto_profil']) && $_FILES['foto_profil']['name'] != ""){
        $foto = $_FILES['foto_profil']['name'];
        $tmp  = $_FILES['foto_profil']['tmp_name'];
        $nama_baru = "profil_".time()."_".$foto;
        $path = "../assets/img_sekolah/" . $nama_baru;
        $old = mysqli_fetch_array(mysqli_query($koneksi, "SELECT gambar_profil FROM profil_sekolah WHERE id='$id'"));
        if(!empty($old['gambar_profil']) && file_exists("../assets/img_sekolah/".$old['gambar_profil'])){
            unlink("../assets/img_sekolah/".$old['gambar_profil']);
        }
        if(move_uploaded_file($tmp, $path)){
            $fields[] = "gambar_profil='$nama_baru'";
        }
    }

    // assemble update
    $query = "UPDATE profil_sekolah SET " . implode(', ', $fields) . " WHERE id='$id'";
    $update = mysqli_query($koneksi, $query);
    if($update){
        echo "<script>alert('Pengaturan Berhasil Diubah'); window.location='pengaturan.php';</script>";
    } else {
        echo "<script>alert('Gagal Mengubah Pengaturan: " . mysqli_error($koneksi) . "'); window.location='pengaturan.php';</script>";
    }
}

// ==========================================================
// 3. KELOLA KOMITE (gambar atau HTML)
// ==========================================================
if(isset($_POST['save_komite'])){
    $file = __DIR__ . '/../assets/content/komite.html';
    // if image uploaded
    if(isset($_FILES['komite_img']) && $_FILES['komite_img']['name'] != ""){
        $foto = $_FILES['komite_img']['name'];
        $tmp = $_FILES['komite_img']['tmp_name'];
        $nama_baru = "komite_".time()."_".$foto;
        $dir = "../assets/img_komite/";
        if(!is_dir($dir)) mkdir($dir, 0755, true);
        $path = $dir . $nama_baru;
        // remove previous image if exists in file
        if(file_exists($file)){
            $old = file_get_contents($file);
            if(preg_match('/<img\s+[^>]*src="([^"]+)"/i', $old, $m)){
                $oldpath = __DIR__ . '/../' . $m[1];
                if(file_exists($oldpath)) unlink($oldpath);
            }
        }
        if(move_uploaded_file($tmp, $path)){
            $html = '<img src="assets/img_komite/'.$nama_baru.'" class="img-fluid" alt="Komite Sekolah">';
            file_put_contents($file, $html);
        }
    } else {
        // use manual HTML (overwrite)
        $content = $_POST['content'] ?? '';
        file_put_contents($file, $content);
    }
    echo "<script>alert('Data Komite berhasil diperbarui'); window.location='komite.php';</script>";
}

// ==========================================================
// 4. KELOLA BERITA
// ==========================================================
if(isset($_POST['simpan_berita'])){
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $status = mysqli_real_escape_string($koneksi, $_POST['simpan_berita']); // Ambil dari tombol yang diklik
    $tanggal = date('Y-m-d'); 
    
    $foto = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $nama_baru = date('dmYHis') . "_" . $foto;
    $path = "../assets/img_berita/" . $nama_baru;

    if(move_uploaded_file($tmp, $path)){
        mysqli_query($koneksi, "INSERT INTO berita (judul, isi, tanggal, gambar, status) VALUES ('$judul', '$isi', '$tanggal', '$nama_baru', '$status')");
        
        // Log notification
        logNotifikasi($koneksi, 'berita', 'ditambahkan', $judul, 'berita.php');
        
        if($status == 'publish'){
            echo "<script>alert('Berita Berhasil Dipublish!'); window.location='berita.php';</script>";
        } else {
            echo "<script>alert('Berita Berhasil Disimpan sebagai Draft'); window.location='berita.php';</script>";
        }
    }
}

if(isset($_POST['update_berita'])){
    $id = $_POST['id'];
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $status = mysqli_real_escape_string($koneksi, $_POST['update_berita']); // Ambil dari tombol yang diklik
    
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
        $query = "UPDATE berita SET judul='$judul', gambar='$nama_baru', status='$status' WHERE id='$id'";
    } else {
        $query = "UPDATE berita SET judul='$judul', status='$status' WHERE id='$id'";
    }
    mysqli_query($koneksi, $query);
    
    // Log notification
    logNotifikasi($koneksi, 'berita', 'diperbarui', $judul, 'berita.php');
    
    if($status == 'publish'){
        echo "<script>alert('Berita Berhasil Dipublish!'); window.location='berita.php';</script>";
    } else {
        echo "<script>alert('Berita Berhasil Disimpan sebagai Draft'); window.location='berita.php';</script>";
    }
}

if(isset($_GET['hapus_berita'])){
    $id = $_GET['hapus_berita'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM berita WHERE id='$id'"));
    if(file_exists("../assets/img_berita/" . $data['gambar'])){
        unlink("../assets/img_berita/" . $data['gambar']);
    }
    
    // Log notification sebelum delete
    logNotifikasi($koneksi, 'berita', 'dihapus', $data['judul'], 'berita.php');
    
    mysqli_query($koneksi, "DELETE FROM berita WHERE id='$id'");
    echo "<script>alert('Berita Berhasil Dihapus'); window.location='berita.php';</script>";
}

// ==========================================================
// 4. KELOLA GALERI
// ==========================================================
if(isset($_POST['simpan_galeri']) || isset($_POST['upload_galeri'])){
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $fotoName = '';
    $tmp = '';

    if(isset($_FILES['gambar']) && $_FILES['gambar']['name'] != ''){
        $fotoName = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
    } elseif(isset($_FILES['foto']) && $_FILES['foto']['name'] != ''){
        $fotoName = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
    }

    if($fotoName && $tmp){
        $nama_baru = date('dmYHis') . "_" . $fotoName;
        $path = "../assets/img_galeri/" . $nama_baru;

        if(move_uploaded_file($tmp, $path)){
            mysqli_query($koneksi, "INSERT INTO galeri (judul, gambar) VALUES ('$judul', '$nama_baru')");
            
            // Log notification
            logNotifikasi($koneksi, 'galeri', 'ditambahkan', $judul, 'galeri.php');
            
            echo "<script>alert('Foto Galeri Berhasil Ditambahkan'); window.location='galeri.php';</script>";
        }
    }
}

if(isset($_POST['update_galeri'])){
    $id = $_POST['id'];
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);

    if(isset($_FILES['gambar']) && $_FILES['gambar']['name'] != ""){
        $foto = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $nama_baru = date('dmYHis') . "_" . $foto;
        $path = "../assets/img_galeri/" . $nama_baru;

        $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM galeri WHERE id='$id'"));
        if($data && file_exists("../assets/img_galeri/" . $data['gambar'])){
            unlink("../assets/img_galeri/" . $data['gambar']);
        }

        if(move_uploaded_file($tmp, $path)){
            $query = "UPDATE galeri SET judul='$judul', gambar='$nama_baru' WHERE id='$id'";
        } else {
            $query = "UPDATE galeri SET judul='$judul' WHERE id='$id'";
        }
    } else {
        $query = "UPDATE galeri SET judul='$judul' WHERE id='$id'";
    }

    mysqli_query($koneksi, $query);
    
    // Log notification
    logNotifikasi($koneksi, 'galeri', 'diperbarui', $judul, 'galeri.php');
    
    echo "<script>alert('Galeri Berhasil Diupdate'); window.location='galeri.php';</script>";
}

if(isset($_GET['hapus_galeri'])){
    $id = $_GET['hapus_galeri'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM galeri WHERE id='$id'"));
    if($data && file_exists("../assets/img_galeri/" . $data['gambar'])){
        unlink("../assets/img_galeri/" . $data['gambar']);
    }
    
    // Log notification sebelum delete
    logNotifikasi($koneksi, 'galeri', 'dihapus', $data['judul'], 'galeri.php');
    
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

// ==========================================================
// 6. KELOLA GURU
// ==========================================================
if(isset($_POST['simpan_guru'])){
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama_guru = mysqli_real_escape_string($koneksi, $_POST['nama_guru']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $bidang_keahlian = mysqli_real_escape_string($koneksi, $_POST['bidang_keahlian']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    
    $foto_name = '';
    if(isset($_FILES['foto']) && $_FILES['foto']['name'] != ''){
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $foto_name = date('dmYHis') . "_" . $foto;
        $path = "../assets/img/" . $foto_name;
        move_uploaded_file($tmp, $path);
    }
    
    $query = "INSERT INTO guru (nip, nama_guru, jabatan, bidang_keahlian, spesialisasi, no_telp, email, foto) 
              VALUES ('$nip', '$nama_guru', '$jabatan', '$bidang_keahlian', '$spesialisasi', '$no_telp', '$email', '$foto_name')";
    
    if(mysqli_query($koneksi, $query)){
        // Log notification
        logNotifikasi($koneksi, 'guru', 'ditambahkan', $nama_guru, 'guru.php');
        
        echo "<script>alert('Guru Berhasil Ditambahkan'); window.location='guru.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan guru: " . mysqli_error($koneksi) . "'); window.location='tambah_guru.php';</script>";
    }
}

if(isset($_POST['update_guru'])){
    $id = intval($_POST['id_guru']);
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama_guru = mysqli_real_escape_string($koneksi, $_POST['nama_guru']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $bidang_keahlian = mysqli_real_escape_string($koneksi, $_POST['bidang_keahlian']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);
    $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM guru WHERE id='$id'"));
    
    if(isset($_FILES['foto']) && $_FILES['foto']['name'] != ''){
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $foto_name = date('dmYHis') . "_" . $foto;
        $path = "../assets/img/" . $foto_name;
        
        // Hapus foto lama jika ada
        if($data && file_exists("../assets/img/" . $data['foto'])){
            unlink("../assets/img/" . $data['foto']);
        }
        
        move_uploaded_file($tmp, $path);
        $query = "UPDATE guru SET nip='$nip', nama_guru='$nama_guru', jabatan='$jabatan', 
                  bidang_keahlian='$bidang_keahlian', spesialisasi='$spesialisasi', 
                  no_telp='$no_telp', email='$email', foto='$foto_name' WHERE id='$id'";
    } else {
        $query = "UPDATE guru SET nip='$nip', nama_guru='$nama_guru', jabatan='$jabatan', 
                  bidang_keahlian='$bidang_keahlian', spesialisasi='$spesialisasi', 
                  no_telp='$no_telp', email='$email' WHERE id='$id'";
    }
    
    if(mysqli_query($koneksi, $query)){
        // Log notification
        logNotifikasi($koneksi, 'guru', 'diperbarui', $nama_guru, 'guru.php');
        
        echo "<script>alert('Guru Berhasil Diupdate'); window.location='guru.php';</script>";
    } else {
        echo "<script>alert('Gagal update guru: " . mysqli_error($koneksi) . "'); window.location='edit_guru.php?id=$id';</script>";
    }
}

if(isset($_GET['hapus_guru'])){
    $id = intval($_GET['hapus_guru']);
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM guru WHERE id='$id'"));
    
    if($data && file_exists("../assets/img/" . $data['foto'])){
        unlink("../assets/img/" . $data['foto']);
    }
    
    // Log notification sebelum delete
    if($data){
        logNotifikasi($koneksi, 'guru', 'dihapus', $data['nama_guru'], 'guru.php');
    }
    
    if(mysqli_query($koneksi, "DELETE FROM guru WHERE id='$id'")){
        echo "<script>alert('Guru Berhasil Dihapus'); window.location='guru.php';</script>";
    } else {
        echo "<script>alert('Gagal hapus guru'); window.location='guru.php';</script>";
    }
}

// ==========================================================
// HAPUS STRUKTUR ORGANISASI
// ==========================================================
if(isset($_GET['hapus_struktur'])){
    $id = intval($_GET['hapus_struktur']);
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM struktur_organisasi WHERE id='$id'"));
    
    if($data && file_exists("../assets/img/" . $data['foto'])){
        unlink("../assets/img/" . $data['foto']);
    }
    
    if(mysqli_query($koneksi, "DELETE FROM struktur_organisasi WHERE id='$id'")){
        echo "<script>alert('Data berhasil dihapus'); window.location='struktur_organisasi.php';</script>";
    } else {
        echo "<script>alert('Gagal hapus data'); window.location='struktur_organisasi.php';</script>";
    }
}

?>
<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = intval($_POST['id']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $urutan = intval($_POST['urutan']);

    // Ambil data lama
    $data_lama = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM struktur_organisasi WHERE id=$id"));
    $foto = $data_lama['foto'];

    // Handle file upload jika ada file baru
    if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0){
        // Hapus file lama jika ada
        if($foto && file_exists("../assets/img/" . $foto)){
            unlink("../assets/img/" . $foto);
        }

        $target_dir = "../assets/img/";
        $file_name = time() . '_' . basename($_FILES['foto']['name']);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi tipe file
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if(in_array($imageFileType, $allowed) && $_FILES['foto']['size'] <= 2000000){
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)){
                $foto = $file_name;
            }
        }
    }

    $query = "UPDATE struktur_organisasi SET 
              jabatan='$jabatan', 
              nama='$nama', 
              foto='$foto', 
              urutan=$urutan 
              WHERE id=$id";

    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Data berhasil diperbarui'); window.location='struktur_organisasi.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "'); window.location='struktur_organisasi.php';</script>";
    }
} else {
    header("Location: struktur_organisasi.php");
    exit;
}
?>

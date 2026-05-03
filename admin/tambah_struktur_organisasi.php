<?php
session_start();
include '../config/koneksi.php';

if(!isset($_SESSION['status_login'])){
    header("Location: login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $urutan = intval($_POST['urutan']);
    $foto = '';

    // Handle file upload
    if(isset($_FILES['foto']) && $_FILES['foto']['size'] > 0){
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

    $query = "INSERT INTO struktur_organisasi (jabatan, nama, foto, urutan) 
              VALUES ('$jabatan', '$nama', '$foto', $urutan)";

    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Data berhasil ditambahkan'); window.location='struktur_organisasi.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah data: " . mysqli_error($koneksi) . "'); window.location='struktur_organisasi.php';</script>";
    }
} else {
    header("Location: struktur_organisasi.php");
    exit;
}
?>

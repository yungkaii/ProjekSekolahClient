<?php
$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "db_purwanida"; // Sesuaikan dengan nama database Anda

$koneksi = mysqli_connect($server, $user, $pass, $db);

if(!$koneksi){
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>
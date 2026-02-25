<?php
include 'config/koneksi.php';
$row = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM profil_sekolah WHERE id=1"));
print_r(array_keys($row));
echo "map_embed value:\n";
var_dump($row['map_embed'] ?? null);
?>
<?php

include '../includes/cek_login.php';

cek_login_siswa();

include '../config/koneksi.php';

$user_id = $_SESSION['user_id'];

$anggota = $koneksi->query("SELECT id FROM anggota WHERE user_id=$user_id")-

>fetch_assoc();

$anggota_id = $anggota['id'];

$sedang_dipinjam = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM peminjaman 

WHERE anggota_id=$anggota_id AND status='dipinjam'")->fetch_assoc()['jml'];

?>
<!DOCTYPE html>

<html>

<head>

 <title>Dashboard Siswa</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Dashboard Siswa</h2>

 <div class="card-group">

 <div class="card"><h3><?= $sedang_dipinjam ?></h3><p>Buku Sedang 

Dipinjam</p></div>

 </div>

</main>

</body>

</html>
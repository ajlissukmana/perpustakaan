<?php

include '../includes/cek_login.php';

cek_login_petugas_atau_admin();

include '../config/koneksi.php';

$total_buku = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM buku")-

>fetch_assoc()['jml'];

$total_pinjam_aktif = mysqli_query($koneksi, "SELECT COUNT(*) as jml FROM peminjaman 

WHERE status='dipinjam'")->fetch_assoc()['jml'];

?>

<!DOCTYPE html>

<html>

<head>

 <title>Dashboard Petugas</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Dashboard Petugas</h2>

 <div class="card-group">
         <div class="card"><h3><?= $total_buku ?></h3><p>Total Buku</p></div>

 <div class="card"><h3><?= $total_pinjam_aktif ?></h3><p>Sedang Dipinjam</p></div>

 </div>

</main>

</body>

</html>
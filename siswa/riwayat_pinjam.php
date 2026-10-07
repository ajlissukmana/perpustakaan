<?php

include '../includes/cek_login.php';

cek_login_siswa();
include '../config/koneksi.php';

$user_id = $_SESSION['user_id'];

$anggota = $koneksi->query("SELECT id FROM anggota WHERE user_id=$user_id")-

>fetch_assoc();

$anggota_id = $anggota['id'];

$riwayat = mysqli_query($koneksi, "

 SELECT b.judul, p.tgl_pinjam, p.tgl_kembali_rencana, p.tgl_kembali_aktual, p.status

 FROM peminjaman p

 JOIN buku b ON p.buku_id = b.id

 WHERE p.anggota_id = $anggota_id

 ORDER BY p.tgl_pinjam DESC

");

?>

<!DOCTYPE html>

<html>

<head>

 <title>Riwayat Peminjaman</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Riwayat Peminjaman Saya</h2>

 <table>
         <tr><th>Judul</th><th>Tgl Pinjam</th><th>Jatuh Tempo</th><th>Tgl 

Kembali</th><th>Status</th></tr>

 <?php while ($row = mysqli_fetch_assoc($riwayat)): ?>

 <tr>

 <td><?= htmlspecialchars($row['judul']) ?></td>

 <td><?= $row['tgl_pinjam'] ?></td>

 <td><?= $row['tgl_kembali_rencana'] ?></td>

 <td><?= $row['tgl_kembali_aktual'] ?? '-' ?></td>

 <td><?= ucfirst($row['status']) ?></td>

 </tr>

 <?php endwhile; ?>

 </table>

</main>

</body>

</html>
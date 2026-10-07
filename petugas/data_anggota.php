<?php

include '../includes/cek_login.php';

cek_login_petugas_atau_admin();

include '../config/koneksi.php';

$anggota = mysqli_query($koneksi, "SELECT a.*, u.nama_lengkap, u.username FROM anggota a 

JOIN users u ON a.user_id = u.id");

?>

<!DOCTYPE html>

<html>

<head>

 <title>Data Anggota</title>

 <link rel="stylesheet" href="../assets/css/style.css">
 </head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Data Anggota (Siswa)</h2>

 <table>

 <tr><th>NIS</th><th>Nama</th><th>Kelas</th><th>Username</th></tr>

 <?php while ($row = mysqli_fetch_assoc($anggota)): ?>

 <tr>

 <td><?= htmlspecialchars($row['nis']) ?></td>

 <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>

 <td><?= htmlspecialchars($row['kelas']) ?></td>

 <td><?= htmlspecialchars($row['username']) ?></td>

 </tr>

 <?php endwhile; ?>

 </table>

</main>

</body>

</html>
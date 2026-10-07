<?php

include '../includes/cek_login.php';

cek_login_petugas_atau_admin();

include '../config/koneksi.php';

$buku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY judul ASC");

?>

<!DOCTYPE html>

<html>

<head>

 <title>Data Buku</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Data Buku (Lihat Saja)</h2>

 <table>

 <tr><th>Kode</th><th>Judul</th><th>Pengarang</th><th>Kategori</th><th>Stok</th></tr>

 <?php while ($row = mysqli_fetch_assoc($buku)): ?>
        <tr>

 <td><?= htmlspecialchars($row['kode_buku']) ?></td>

 <td><?= htmlspecialchars($row['judul']) ?></td>

 <td><?= htmlspecialchars($row['pengarang']) ?></td>

 <td><?= htmlspecialchars($row['kategori']) ?></td>

 <td><?= $row['stok'] ?></td>

 </tr>

 <?php endwhile; ?>

 </table>

</main>

</body>

</html>
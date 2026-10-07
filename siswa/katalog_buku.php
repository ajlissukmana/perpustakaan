<?php

include '../includes/cek_login.php';

cek_login_siswa();

include '../config/koneksi.php';

$buku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY judul ASC");

?>

<!DOCTYPE html>

<html>
        <head>

 <title>Katalog Buku</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Katalog Buku</h2>

 <table>

 <tr><th>Judul</th><th>Pengarang</th><th>Kategori</th><th>Status</th></tr>

 <?php while ($row = mysqli_fetch_assoc($buku)): ?>

 <tr>

 <td><?= htmlspecialchars($row['judul']) ?></td>

 <td><?= htmlspecialchars($row['pengarang']) ?></td>

 <td><?= htmlspecialchars($row['kategori']) ?></td>

 <td><?= $row['stok'] > 0 ? "Tersedia (" . $row['stok'] . ")" : "Kosong" ?></td>

 </tr>

 <?php endwhile; ?>

 </table>

</main>

</body>

</html>
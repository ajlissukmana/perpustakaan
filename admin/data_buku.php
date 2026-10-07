<?php

include '../includes/cek_login.php';

cek_login_admin();

include '../config/koneksi.php';

$buku = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY judul ASC");

?>
<!DOCTYPE html>

<html>

<head>

 <title>Kelola Buku</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Kelola Buku</h2>

 <a href="tambah_buku.php" class="btn">+ Tambah Buku</a>

 <table>

 

<tr><th>Kode</th><th>Judul</th><th>Pengarang</th><th>Kategori</th><th>Stok</th><th>Aksi

</th></tr>

 <?php while ($row = mysqli_fetch_assoc($buku)): ?>

 <tr>

 <td><?= htmlspecialchars($row['kode_buku']) ?></td>

 <td><?= htmlspecialchars($row['judul']) ?></td>

 <td><?= htmlspecialchars($row['pengarang']) ?></td>

 <td><?= htmlspecialchars($row['kategori']) ?></td>

 <td><?= $row['stok'] ?></td>

 <td>

 <a href="edit_buku.php?id=<?= $row['id'] ?>">Edit</a> |

 <a href="hapus_buku.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus 

buku ini?')">Hapus</a>

        </td>
        </tr>

 <?php endwhile; ?>

 </table>

</main>

</body>

</html>
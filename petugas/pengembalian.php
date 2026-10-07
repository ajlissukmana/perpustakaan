<?php

include '../includes/cek_login.php';

cek_login_petugas_atau_admin();

include '../config/koneksi.php';

if (isset($_GET['kembalikan'])) {

 $id = (int) $_GET['kembalikan'];

 $tgl_kembali_aktual = date('Y-m-d');

 $data = $koneksi->query("SELECT * FROM peminjaman WHERE id=$id")->fetch_assoc();

 $status = ($tgl_kembali_aktual > $data['tgl_kembali_rencana']) ? 'terlambat' : 'dikembalikan';

 $stmt = $koneksi->prepare("UPDATE peminjaman SET tgl_kembali_aktual=?, status=? 

WHERE id=?");

 $stmt->bind_param("ssi", $tgl_kembali_aktual, $status, $id);

 $stmt->execute();

 $koneksi->query("UPDATE buku SET stok = stok + 1 WHERE id = " . $data['buku_id']);
        header("Location: pengembalian.php");

 exit();

}

$aktif = mysqli_query($koneksi, "

 SELECT p.id, u.nama_lengkap, b.judul, p.tgl_pinjam, p.tgl_kembali_rencana

 FROM peminjaman p

 JOIN anggota a ON p.anggota_id = a.id

 JOIN users u ON a.user_id = u.id

 JOIN buku b ON p.buku_id = b.id

 WHERE p.status = 'dipinjam'

");

?>

<!DOCTYPE html>

<html>

<head>

 <title>Pengembalian Buku</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Daftar Buku Dipinjam</h2>

 <table>

 <tr><th>Siswa</th><th>Judul Buku</th><th>Tgl Pinjam</th><th>Jatuh 

Tempo</th><th>Aksi</th></tr>
<?php while ($row = mysqli_fetch_assoc($aktif)): ?>

 <tr>

 <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>

 <td><?= htmlspecialchars($row['judul']) ?></td>

 <td><?= $row['tgl_pinjam'] ?></td>

 <td><?= $row['tgl_kembali_rencana'] ?></td>

 <td><a href="?kembalikan=<?= $row['id'] ?>" onclick="return confirm('Sudah 

dikembalikan?')">Tandai Kembali</a></td>

 </tr>

 <?php endwhile; ?>

 </table>

</main>

</body>

</html>
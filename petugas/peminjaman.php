<?php

include '../includes/cek_login.php';

cek_login_petugas_atau_admin();

include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $anggota_id = (int) $_POST['anggota_id'];

 $buku_id = (int) $_POST['buku_id'];

 $tgl_pinjam = date('Y-m-d');

 $tgl_kembali_rencana = date('Y-m-d', strtotime('+7 days'));

 $petugas_id = $_SESSION['user_id'];

 $cek = $koneksi->prepare("SELECT stok FROM buku WHERE id=?");

 $cek->bind_param("i", $buku_id);

 $cek->execute();

 $stok = $cek->get_result()->fetch_assoc()['stok'];

 if ($stok > 0) {

 $stmt = $koneksi->prepare("INSERT INTO peminjaman (anggota_id, buku_id, tgl_pinjam, 

tgl_kembali_rencana, petugas_id) VALUES (?, ?, ?, ?, ?)");

 $stmt->bind_param("iissi", $anggota_id, $buku_id, $tgl_pinjam, $tgl_kembali_rencana, 

$petugas_id);

 $stmt->execute();

 $koneksi->query("UPDATE buku SET stok = stok - 1 WHERE id = $buku_id");

 $sukses = "Peminjaman berhasil dicatat.";

 } else {

 $error = "Stok buku habis.";

 }

}

$anggota = mysqli_query($koneksi, "SELECT a.id, u.nama_lengkap FROM anggota a JOIN users 

u ON a.user_id=u.id");

$buku = mysqli_query($koneksi, "SELECT id, judul, stok FROM buku WHERE stok > 0");
?>

<!DOCTYPE html>

<html>

<head>

 <title>Peminjaman Buku</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Catat Peminjaman Buku</h2>

 <?php if (isset($sukses)) echo "<p class='sukses'>$sukses</p>"; ?>

 <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

 <form method="POST" class="form-box">

 <label>Siswa</label>

 <select name="anggota_id" required>

 <?php while ($a = mysqli_fetch_assoc($anggota)): ?>

 <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nama_lengkap']) ?></option>

 <?php endwhile; ?>

 </select>

 <label>Buku</label>

 <select name="buku_id" required>

 <?php while ($b = mysqli_fetch_assoc($buku)): ?>

 <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['judul']) ?> (stok: <?= 

$b['stok'] ?>)</option>

 <?php endwhile; ?>
</select>

 <p>Jatuh tempo otomatis: 7 hari dari hari ini.</p>

 <button type="submit">Catat Peminjaman</button>

 </form>

</main>

</body>

</html>
<?php

include '../includes/cek_login.php';

cek_login_admin();

include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 $stmt = $koneksi->prepare("INSERT INTO buku (kode_buku, judul, pengarang, penerbit, 

kategori, stok) VALUES (?, ?, ?, ?, ?, ?)");

 $stmt->bind_param("sssssi", $_POST['kode_buku'], $_POST['judul'], $_POST['pengarang'], 

$_POST['penerbit'], $_POST['kategori'], $_POST['stok']);

 $stmt->execute();

 header("Location: data_buku.php");

 exit();

}

?>

<!DOCTYPE html>

<html>

<head>

 <title>Tambah Buku</title>

 <link rel="stylesheet" href="../assets/css/style.css">
 </head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Tambah Buku</h2>

 <form method="POST" class="form-box">

 <label>Kode Buku</label>

 <input type="text" name="kode_buku" required>

 <label>Judul</label>

 <input type="text" name="judul" required>

 <label>Pengarang</label>

 <input type="text" name="pengarang">

 <label>Penerbit</label>

 <input type="text" name="penerbit">

 <label>Kategori</label>

 <input type="text" name="kategori">

 <label>Stok</label>

 <input type="number" name="stok" min="0" required>

 <button type="submit">Simpan</button>

 </form>

</main>

</body>

</html>
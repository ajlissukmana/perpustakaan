<?php

include '../includes/cek_login.php';
cek_login_admin();

include '../config/koneksi.php';

$id = (int) $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 $stmt = $koneksi->prepare("UPDATE buku SET kode_buku=?, judul=?, pengarang=?, 

penerbit=?, kategori=?, stok=? WHERE id=?");

 $stmt->bind_param("sssssii", $_POST['kode_buku'], $_POST['judul'], $_POST['pengarang'], 

$_POST['penerbit'], $_POST['kategori'], $_POST['stok'], $id);

 $stmt->execute();

 header("Location: data_buku.php");

 exit();

}

$stmt = $koneksi->prepare("SELECT * FROM buku WHERE id=?");

$stmt->bind_param("i", $id);

$stmt->execute();

$buku = $stmt->get_result()->fetch_assoc();

?>

<!DOCTYPE html>

<html>

<head>

 <title>Edit Buku</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Edit Buku</h2>
 <form method="POST" class="form-box">

 <label>Kode Buku</label>

 <input type="text" name="kode_buku" value="<?= htmlspecialchars($buku['kode_buku']) ?>" 

required>

 <label>Judul</label>

 <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']) ?>" required>

 <label>Pengarang</label>

 <input type="text" name="pengarang" value="<?= htmlspecialchars($buku['pengarang']) ?>">

 <label>Penerbit</label>

 <input type="text" name="penerbit" value="<?= htmlspecialchars($buku['penerbit']) ?>">

 <label>Kategori</label>

 <input type="text" name="kategori" value="<?= htmlspecialchars($buku['kategori']) ?>">

 <label>Stok</label>

 <input type="number" name="stok" value="<?= $buku['stok'] ?>" min="0" required>

 <button type="submit">Update</button>

 </form>

</main>

</body>

</html>
<?php

include '../includes/cek_login.php';

cek_login_admin();

include '../config/koneksi.php';
$id = (int) $_GET['id'];

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 $nama_lengkap = trim($_POST['nama_lengkap']);

 $password = $_POST['password'];

 if (!empty($password)) {

 $hash = password_hash($password, PASSWORD_DEFAULT);

 $stmt = $koneksi->prepare("UPDATE users SET nama_lengkap=?, password=? WHERE 

id=?");

 $stmt->bind_param("ssi", $nama_lengkap, $hash, $id);

 } else {

 $stmt = $koneksi->prepare("UPDATE users SET nama_lengkap=? WHERE id=?");

 $stmt->bind_param("si", $nama_lengkap, $id);

 }

 $stmt->execute();

 header("Location: data_user.php");

 exit();

}

$stmt = $koneksi->prepare("SELECT * FROM users WHERE id=?");

$stmt->bind_param("i", $id);

$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

?>
<!DOCTYPE html>

<html>

<head>

 <title>Edit User</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Edit User: <?= htmlspecialchars($user['username']) ?> (<?= ucfirst($user['role']) ?>)</h2>

 <form method="POST" class="form-box">

 <label>Nama Lengkap</label>

 <input type="text" name="nama_lengkap" value="<?= 

htmlspecialchars($user['nama_lengkap']) ?>" required>

 <label>Password Baru (kosongkan jika tidak diubah)</label>

 <input type="password" name="password">

 <button type="submit">Update</button>

 </form>

</main>

</body>

         </html>
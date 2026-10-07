<?php

include '../includes/cek_login.php';

cek_login_admin();
include '../config/koneksi.php';

$id = (int) $_GET['id'];

// Cegah admin menghapus akunnya sendiri

if ($id == $_SESSION['user_id']) {

 header("Location: data_user.php");

 exit();

}

// Hapus data anggota terkait dulu (jika ada), baru hapus user

$koneksi->query("DELETE FROM anggota WHERE user_id = $id");

$stmt = $koneksi->prepare("DELETE FROM users WHERE id=?");

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: data_user.php");

exit();

?>
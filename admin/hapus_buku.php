<?php

include '../includes/cek_login.php';

cek_login_admin();

include '../config/koneksi.php';

$id = (int) $_GET['id'];

$stmt = $koneksi->prepare("DELETE FROM buku WHERE id=?");

$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: data_buku.php");

exit();

?>
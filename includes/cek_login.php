<?php
session_start();
function cek_login_admin() {
 if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
header("Location: /perpustakaan/admin/dashboard.php");
exit();
 }
}
function cek_login_petugas_atau_admin() {
 if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['petugas', 'admin'])) {
 header("Location: /perpustakaan/auth/login.php");
 exit();
 }
}
function cek_login_siswa() {
 if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'siswa') {
 header("Location: /perpustakaan/auth/login.php");

 }
}
?>
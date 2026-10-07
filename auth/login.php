<?php
session_start();

session_unset();
session_destroy();
session_start();
include '../config/koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $username = mysqli_real_escape_string($koneksi, $_POST['username']);
 $password = $_POST['password'];
 $stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
 $stmt->bind_param("s", $username);
 $stmt->execute();
 $result = $stmt->get_result();
 if ($result->num_rows == 1) {
 $user = $result->fetch_assoc();
 if (password_verify($password, $user['password'])) {
 session_regenerate_id(true);
 $_SESSION['user_id'] = $user['id'];
 $_SESSION['username'] = $user['username'];
 $_SESSION['role'] = $user['role'];
 $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
 if ($user['role'] == 'admin') {
 header("Location: ../admin/dashboard.php");
 } elseif ($user['role'] == 'petugas') {
 header("Location: ../petugas/dashboard.php");
 } else {
 header("Location: ../siswa/dashboard.php");
 }
 exit();
 } else {
 $error = "Username atau password salah.";
 }
 } else {
 $error = "Username atau password salah.";
 }
}
?>
<!DOCTYPE html>
<html>
<head>
 <title>Login - Perpustakaan</title>
 <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
 <div class="login-box">
 <h2>Login Perpustakaan</h2>
 <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
 <form method="POST">
 <label>Username</label>
 <input type="text" name="username" required>
 <label>Password</label>
 <input type="password" name="password" required>
 <button type="submit">Login</button>
 </form>
 </div>
</body>
</html>
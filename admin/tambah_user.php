<?php

include '../includes/cek_login.php';

cek_login_admin();

include '../config/koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 $username = trim($_POST['username']);

 $nama_lengkap = trim($_POST['nama_lengkap']);

 $role = $_POST['role'];

 $password = $_POST['password'];

 // Cek username sudah dipakai atau belum

 $cek = $koneksi->prepare("SELECT id FROM users WHERE username=?");

 $cek->bind_param("s", $username);

 $cek->execute();
        if ($cek->get_result()->num_rows > 0) {

 $error = "Username sudah digunakan, silakan pilih yang lain.";

 } else {

 $hash = password_hash($password, PASSWORD_DEFAULT);

 $stmt = $koneksi->prepare("INSERT INTO users (username, password, role, nama_lengkap) 

VALUES (?, ?, ?, ?)");

 $stmt->bind_param("ssss", $username, $hash, $role, $nama_lengkap);

 $stmt->execute();

 $new_user_id = $koneksi->insert_id;

 // Jika role siswa, otomatis buat data anggota juga

 if ($role == 'siswa') {

 $nis = trim($_POST['nis']);

 $kelas = trim($_POST['kelas']);

 $stmt2 = $koneksi->prepare("INSERT INTO anggota (user_id, nis, kelas) VALUES (?, ?, 

?)");

 $stmt2->bind_param("iss", $new_user_id, $nis, $kelas);

 $stmt2->execute();

 }

 header("Location: data_user.php");

 exit();

 }

}

?>

<!DOCTYPE html>

<html>
        <head>

 <title>Tambah User</title>

 <link rel="stylesheet" href="../assets/css/style.css">

 <script>

 function toggleFieldSiswa() {

 var role = document.getElementById('role').value;

 document.getElementById('field-siswa').style.display = (role === 'siswa') ? 'block' : 'none';

 }

 </script>

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Tambah User Baru</h2>

 <?php if ($error) echo "<p class='error'>$error</p>"; ?>

 <form method="POST" class="form-box">

 <label>Role</label>

 <select name="role" id="role" onchange="toggleFieldSiswa()" required>

 <option value="">-- Pilih Role --</option>

 <option value="admin">Admin</option>

 <option value="petugas">Petugas</option>

 <option value="siswa">Siswa</option>

 </select>

 <label>Username</label>

 <input type="text" name="username" required>
 <label>Password</label>

 <input type="password" name="password" required>

 <label>Nama Lengkap</label>

 <input type="text" name="nama_lengkap" required>

 <div id="field-siswa" style="display:none;">

 <label>NIS</label>

 <input type="text" name="nis">

 <label>Kelas</label>

 <input type="text" name="kelas">

 </div>

 <button type="submit">Simpan User</button>

 </form>

</main>

</body>

        </html>
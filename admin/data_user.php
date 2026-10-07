<?php

include '../includes/cek_login.php';

cek_login_admin();

include '../config/koneksi.php';

$users = mysqli_query($koneksi, "SELECT * FROM users ORDER BY role, nama_lengkap");

?>
<!DOCTYPE html>

<html>

<head>

 <title>Kelola User</title>

 <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<?php include '../includes/header.php'; ?>

<main class="container">

 <h2>Kelola User</h2>

 <a href="tambah_user.php" class="btn">+ Tambah User</a>

 <table>

 <tr><th>Username</th><th>Nama Lengkap</th><th>Role</th><th>Aksi</th></tr>

 <?php while ($row = mysqli_fetch_assoc($users)): ?>

 <tr>

 <td><?= htmlspecialchars($row['username']) ?></td>

 <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>

 <td><?= ucfirst($row['role']) ?></td>

 <td>

 <a href="edit_user.php?id=<?= $row['id'] ?>">Edit</a> |

 <?php if ($row['id'] != $_SESSION['user_id']): ?>

 <a href="hapus_user.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus 

user ini?')">Hapus</a>

 <?php else: ?>

 <span style="color:#999;">(akun Anda)</span>

 <?php endif; ?>
        </td>

 </tr>

 <?php endwhile; ?>

 </table>

</main>

<?php include '../includes/footer.php'; ?>

</body>

</html>
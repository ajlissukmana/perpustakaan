<header class="navbar">

 <h3> Perpustakaan Sekolah</h3>

 <nav>

 <?php if ($_SESSION['role'] == 'admin'): ?>

 <a href="/perpustakaan/admin/dashboard.php">Dashboard</a>

 <a href="/perpustakaan/admin/data_user.php">Kelola User</a>

 <a href="/perpustakaan/admin/data_buku.php">Kelola Buku</a>

 <a href="/perpustakaan/petugas/data_anggota.php">Data Anggota</a>

 <a href="/perpustakaan/petugas/peminjaman.php">Peminjaman</a>

 <a href="/perpustakaan/petugas/pengembalian.php">Pengembalian</a>

 <?php elseif ($_SESSION['role'] == 'petugas'): ?>

 <a href="/perpustakaan/petugas/dashboard.php">Dashboard</a>

 <a href="/perpustakaan/petugas/data_buku.php">Data Buku</a>
 <a href="/perpustakaan/petugas/data_anggota.php">Data Anggota</a>

 <a href="/perpustakaan/petugas/peminjaman.php">Peminjaman</a>

 <a href="/perpustakaan/petugas/pengembalian.php">Pengembalian</a>

 <?php else: ?>

 <a href="/perpustakaan/siswa/dashboard.php">Dashboard</a>

 <a href="/perpustakaan/siswa/katalog_buku.php">Katalog Buku</a>

 <a href="/perpustakaan/siswa/riwayat_pinjam.php">Riwayat Pinjam</a>

 <?php endif; ?>

 <span>Halo, <?= htmlspecialchars($_SESSION['nama_lengkap']) ?> (<?= $_SESSION['role'] 

?>)</span>

 <a href="/perpustakaan/auth/logout.php">Logout</a>

 </nav>

        </header>
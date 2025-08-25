<?php
session_start();

// Cek login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['user'];
$page = $_GET['page'] ?? 'home';

require 'functions.php';
$siswa = mysqli_query($conn, "SELECT * FROM siswa");

// Proses tambah data
if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'welcome.php?page=laporan';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan!');
            document.location.href = 'welcome.php?page=laporan';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

   <div class="sidebar">
    <h2>Menu</h2>
    <div class="menu">
        <a href="welcome.php?page=home">Home</a>
        <a href="welcome.php?page=nilai">Nilai</a>
        <a href="welcome.php?page=kehadiran">Kehadiran</a>
        <a href="welcome.php?page=jadwal">Jadwal</a>
        <a href="welcome.php?page=pengaturan">Pengaturan</a>
        <a href="welcome.php?page=laporan">Laporan</a>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

    <div class="content">
        <h2>Selamat datang, <?= htmlspecialchars($username); ?>!</h2>
        <?php
        switch ($page) {
            case 'home':
                echo "<p>Ringkasan dashboard...</p>";
                break;
            case 'nilai':
                echo "<p>Data nilai siswa...</p>";
                break;
            case 'kehadiran':
                echo "<p>Rekap absensi siswa...</p>";
                break;
            case 'jadwal':
                echo "<p>Jadwal pelajaran...</p>";
                break;
            case 'pengaturan':
                echo "<p>Pengaturan akun...</p>";
                break;
            case 'laporan':
        ?>
                <h3>Laporan Siswa</h3>

                <!-- Card Form -->
                <div class="card form-card">
                    <h4>Tambah Siswa Baru</h4>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" required>

                        <label for="nis">NIS:</label>
                        <input type="text" id="nis" name="nis" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>

                        <label for="jurusan">Jurusan:</label>
                        <select name="jurusan" id="jurusan" required>
                            <option value="">-- Pilih Jurusan --</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informatika">Sistem Informatika</option>
                        </select>

                        <label for="gambar">Gambar Profil:</label>
                        <input type="file" name="gambar" id="gambar" accept="image/*">

                        <button type="submit" name="submit">Tambah Siswa</button>
                    </form>
                </div>

                <h4>Daftar Siswa</h4>
                <div class="card table-card">
                    <table>
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Email</th>
                                <th>Jurusan</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($siswa)) : ?>
                                <tr>
                                    <td colspan="7" style="text-align:center; padding:20px;">Data kosong.</td>
                                </tr>
                            <?php else: ?>
                                <?php $i = 1;
                                foreach ($siswa as $row): ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= htmlspecialchars($row['nama']); ?></td>
                                        <td><?= htmlspecialchars($row['nis']); ?></td>
                                        <td><?= htmlspecialchars($row['email']); ?></td>
                                        <td><?= htmlspecialchars($row['jurusan']); ?></td>
                                        <td><img src="image/<?= htmlspecialchars($row['gambar']); ?>" class="thumb"></td>
                                        <td class="aksi-btns">
                                            <a href="view.php?id=<?= $row['id']; ?>" class="view">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <a href="edit.php?id=<?= $row['id']; ?>" class="edit">
                                                <i class="fas fa-edit"></i> Ubah
                                            </a>
                                            <a href="hapus.php?id=<?= $row['id']; ?>" class="delete">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
        <?php
                break;
            default:
                echo "<h3>Halaman tidak ditemukan</h3>";
                break;
        }
        ?>
    </div>
</body>
</html>

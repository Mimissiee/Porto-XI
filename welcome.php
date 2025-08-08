<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: loginpage.php");
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex; /* Supaya sidebar dan content sejajar */
        }
        /* Sidebar */
        .sidebar {
            background-color: #333;
            width: 200px;
            height: 100vh; /* penuh tinggi layar */
            padding-top: 20px;
            display: flex;
            flex-direction: column;
        }
        .sidebar a {
            color: white;
            padding: 12px 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #555;
        }
        /* Konten */
        .content {
            flex: 1; /* supaya konten melebar */
            padding: 20px;
        }
        h1 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <a href="?page=home">Home</a>
    <a href="?page=nilai">Nilai</a>
    <a href="?page=kehadiran">Kehadiran</a>
    <a href="?page=jadwal">Jadwal</a>
    <a href="?page=pengaturan">Pengaturan</a>
    <a href="?page=laporan">Laporan</a>
</div>

<!-- Isi Halaman -->
<div class="content">
<?php
switch ($page) {
    case 'home':
        echo "<h1>Halaman Home</h1>";
        echo "<p>Selamat datang, " . $_SESSION['user'] . "! Ini adalah halaman home dashboard.</p>";
        break;
    case 'nilai':
        echo "<h1>Halaman Nilai</h1>";
        echo "<p>Ini tampilan nilai kamu.</p>";
        break;
    case 'kehadiran':
        echo "<h1>Halaman Kehadiran</h1>";
        echo "<p>Ini tampilan kehadiran kamu.</p>";
        break;
    case 'jadwal':
        echo "<h1>Halaman Jadwal</h1>";
        echo "<p>Ini tampilan halaman jadwal.</p>";
        break;
    case 'pengaturan':
        echo "<h1>Halaman Pengaturan</h1>";
        echo "<p>Ini tampilan halaman pengaturan.</p>";
        break;
    case 'laporan':
        echo "<h1>Halaman Laporan</h1>";
        echo "<p>Ini tampilan halaman laporan.</p>";
        break;
    default:
        echo "<h1>404 - Halaman tidak ditemukan</h1>";
        break;
}
?>
</div>

</body>
</html>

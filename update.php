<?php
require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data siswa berdasarkan id
$result = mysqli_query($conn, "SELECT * FROM siswa WHERE id = $id");
$siswa = mysqli_fetch_assoc($result); // ambil sekali saja

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    if (update($_POST) > 0) {
        echo "
            <script>
                document.location.href = 'welcome.php?page=laporan';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'welcome.php?page=laporan';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah Data Siswa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="content">
        <div class="update-form-card">
            <h3>Form Ubah Data Siswa</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="hidden" name="gambarLama" value="<?= $siswa['gambar']; ?>">

                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?= $siswa['nama']; ?>">

                <label for="nis">NIS :</label>
                <input type="text" name="nis" id="nis" required value="<?= $siswa['nis']; ?>">

                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required value="<?= $siswa['email']; ?>">

                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required value="<?= $siswa['jurusan']; ?>">

                <label for="gambar">Gambar :</label>
                <img src="img/<?= $siswa['gambar']; ?>" alt="Foto Siswa">
                <input type="file" name="gambar" id="gambar">

                <button type="submit" name="submit">Ubah Data!</button>
            </form>
        </div>
    </div>
</body>
</html>

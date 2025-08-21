<?php
$conn = mysqli_connect("localhost", "root", "", "belajardata");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function upload() {
    if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] === 4) {
        return 'default.png'; // kalau tidak ada gambar diupload
    }

    $namaFile = $_FILES['gambar']['name'];
    $tmpName  = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmpName, 'image/' . $namaFile);
    return $namaFile;
}

function tambah($data) {
    global $conn;

    $nama    = htmlspecialchars($data['nama']);
    $nis     = htmlspecialchars($data['nis']);
    $email   = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar  = upload();

    $query = "INSERT INTO siswa VALUES ('', '$nama', '$nis', '$email', '$jurusan', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>

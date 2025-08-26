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
    // cek apakah tidak ada gambar yang diupload
    if ($_FILES['gambar']['error'] === 4) {
        return 'default.png'; // default jika tidak ada file
    }

    $namaFile = $_FILES['gambar']['name'];
    $tmpName  = $_FILES['gambar']['tmp_name'];

    // direktori tujuan
    $targetDir  = 'image/';
    $targetFile = $targetDir . basename($namaFile);

    // pindahkan file
    if (move_uploaded_file($tmpName, $targetFile)) {
        return $namaFile;
    } else {
        return 'default.png';
    }
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

// 

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
    
    return mysqli_affected_rows($conn);
}

// 

function update($data) {
    global $conn;

    $id      = $data['id'];
    $nama    = htmlspecialchars($data['nama']);
    $nis     = htmlspecialchars($data['nis']);
    $email   = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE siswa SET
                nama    = '$nama',
                nis     = '$nis',
                email   = '$email',
                jurusan = '$jurusan',
                gambar  = '$gambar'
              WHERE id = $id";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>

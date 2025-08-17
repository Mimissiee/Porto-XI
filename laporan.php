<?php
if (!isset($_SESSION['user'])) {
  header("Location: loginpage.php"); 
  exit;
}

require 'function.php';
$siswa = mysqli_query($conn, "SELECT * FROM siswa");
?>

<!-- Konten Laporan -->
<div class="laporan-wrapper">

  <div class="detail-card">
    <div class="detail-header">
      <h2>Insert Student Report</h2>
      <small>15 August 2025</small>
    </div>
    <p>Silakan isi data siswa di bawah ini untuk membuat laporan baru.</p>

    <!-- Form input -->
    <div class="comment-box">
      <strong>Nama</strong>
      <div class="comment-input">
        <input type="text" placeholder="Tulis nama..." />
      </div>
    </div>

    <div class="comment-box">
      <strong>NIS</strong>
      <div class="comment-input">
        <input type="text" placeholder="Tulis NIS..." />
      </div>
    </div>

    <div class="comment-box">
      <strong>Email</strong>
      <div class="comment-input">
        <input type="text" placeholder="Tulis email..." />
      </div>
    </div>

    <div class="comment-box">
      <strong>Jurusan</strong>
      <div class="comment-input">
        <input type="text" placeholder="Tulis jurusan..." />
      </div>
    </div>

    <button class="btn-brown">Kirim Laporan</button>
  </div>

  <div class="container">
      <div class="top-bar">
          <div>
              <h1>Daftar Laporan Siswa</h1>
          </div>
          <div>
              <a href="laporan.php" class="btn secondary">Refresh</a>
              <a href="#" class="btn">Tambah Baru</a>
          </div>
      </div>

      <table>
          <thead>
              <tr>
                  <th style="width:56px">No</th>
                  <th>Nama</th>
                  <th>NIS</th>
                  <th>Email</th>
                  <th>Jurusan</th>
                  <th>Gambar</th>
                  <th style="width:200px">Aksi</th>
              </tr>
          </thead>
          <tbody>
              <?php if (empty($siswa)): ?>
                  <tr>
                      <td colspan="7" style="text-align:center; padding:30px;">Data kosong.</td>
                  </tr>
              <?php else: ?>
                  <?php $i = 1; foreach ($siswa as $row): ?>
                  <tr>
                       <td><?= $i++; ?></td>
                       <td><?= htmlspecialchars($row['nama']); ?></td>
                       <td><?= htmlspecialchars($row['nis']); ?></td>
                       <td><?= htmlspecialchars($row['email']); ?></td>
                       <td><?= htmlspecialchars($row['jurusan']); ?></td>
                       <td>
                          <img src="<?= htmlspecialchars($row['gambar']); ?>" alt="gambar-<?= $i ?>" class="thumb">
                       </td>
                       <td class="aksi-btns">
                          <a href="view.php?nis=<?= urlencode($row['nis']); ?>" class="view">View</a>
                          <a href="edit.php?nis=<?= urlencode($row['nis']); ?>" class="edit">Edit</a>
                          <a href="delete.php?nis=<?= urlencode($row['nis']); ?>" class="delete" onclick="return confirm('Hapus data <?= addslashes($row['nama']) ?>?')">Delete</a>
                       </td>
                  </tr>
                  <?php endforeach; ?>
              <?php endif; ?>
          </tbody>
      </table>
  </div>
</div>

<style>
/* Wrapper biar konsisten dengan dashboard */
.laporan-wrapper {
  padding: 20px;
  background: #f5f6f7;
}

/* Card untuk form */
.detail-card {
  background: white;
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 20px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.detail-header {
  margin-bottom: 15px;
}

/* Tombol */
.btn-brown {
  background: #2d8f4f;
  color: white;
  padding: 8px 15px;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  margin-top: 10px;
}
.btn-brown:hover {
  background: #1f6d3a;
}

/* Input */
.comment-box {
  margin-top: 10px;
}
.comment-input {
  display: flex;
  border: 1px solid #ccc;
  border-radius: 5px;
  overflow: hidden;
}
.comment-input input {
  flex: 1;
  border: none;
  padding: 8px;
  outline: none;
  font-size: 14px;
}

/* Table */
.top-bar {
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom: 15px;
}
.btn {
  display:inline-block;
  padding:6px 12px;
  background:#2d8f4f;
  color:white;
  text-decoration:none;
  border-radius:4px;
  font-size:14px;
}
.btn.secondary { background:#3498db; }
table {
  width:100%;
  border-collapse:collapse;
  background:white;
  box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
th, td {
  padding:10px 12px;
  border-bottom:1px solid #eee;
  text-align:left;
  vertical-align:middle;
}
th {
  background:#fafafa;
  font-weight:600;
}
.thumb {
  width:60px;
  height:60px;
  object-fit:cover;
  border-radius:6px;
  border:1px solid #ddd;
}
.aksi-btns a {
  margin-right:6px;
  font-size:13px;
  padding:6px 8px;
  border-radius:4px;
  text-decoration:none;
  color:white;
}
.aksi-btns .view { background:#27ae60; }
.aksi-btns .edit { background:#f39c12; }
.aksi-btns .delete { background:#e74c3c; }
</style>

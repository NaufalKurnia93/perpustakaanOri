<?php

if (empty($_GET['id_peminjaman'])) {
  header("location: index.php?page=peminjaman");
  exit(); // kode selanjut nya tidak akan di eksekusi
}

$id_peminjaman = $_GET['id_peminjaman'];
$pdo = dataBase::connect();
$peminjaman = Peminjaman::getInstance($pdo);

// Jika tombol 'save' ditekan
if (isset($_POST['save'])) {
  $id_anggota = htmlspecialchars($_POST['nama_anggota']);
  $tanggal_pinjam = htmlspecialchars($_POST['tanggal_pinjam']);
  $tanggal_kembali = htmlspecialchars($_POST['tanggal_kembali']);
  $id_petugas = htmlspecialchars($_POST['nama_petugas']);

  // Coba edit data buku dan cek hasilnya
  if ($peminjaman->edit($id_peminjaman, $id_anggota, $tanggal_pinjam, $tanggal_kembali, $id_petugas)) {
    header("location: index.php?page=peminjaman&cek=updt");
    // exit();
  } else {
    echo "maaf data gagal di simpan";
  }

  // Jika tombol 'save' tidak ditekan, blok ini akan dieksekusi
} else {
  $data = $peminjaman->getID($id_peminjaman);
  if (!$data) {
    header("location: index.php?page=peminjaman");
    exit();
  }

  //// Ambil data peminjaman untuk ditampilkan di form
  $id_anggota = htmlspecialchars($data['id_anggota']);
  $tanggal_pinjam = htmlspecialchars($data['tanggal_pinjam']);
  $tanggal_kembali = htmlspecialchars($data['tanggal_kembali']);
  $id_petugas = htmlspecialchars($data['id_petugas']);
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit Peminjaman</title>
</head>

<body>

  <div class="container" style="margin-top: 80px">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            Edit peminjaman
          </div>
          <div class="card-body">
            <form action="" method="POST">

              <div class="form-group mb-2">
                <label class="form-label">Anggota</label>
                <select class="form-control" name="nama_anggota">
                  <option value="">--pilih anggota--</option>
                  <?php
                  $pdo = dataBase::connect();
                  $peminjaman = Peminjaman::getInstance($pdo);
                  ?>
                  <?php foreach ($peminjaman->getAnggota() as $anggota): ?>
                    <option value="<?= $anggota['id_anggota'] ?>">
                      <?= $anggota['nama_anggota'] ?>
                    </option>
                  <?php endforeach; ?>

                </select>
              </div>

              <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" value="<?php echo $tanggal_pinjam; ?>"
                  placeholder="Masukkan tanggal pinjam" class="form-control">
              </div>

              <div class="form-group">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" value="<?php echo $tanggal_kembali; ?>"
                  placeholder="Masukkan tanggal_kembali" class="form-control">
              </div>


              <div class="form-group mb-2">
                <label class="form-label">Petugas</label>
                <select class="form-control" name="nama_petugas">
                  <option value="">--petugas--</option>
                  <?php
                  $pdo = dataBase::connect();
                  $peminjaman = Peminjaman::getInstance($pdo);
                  ?>
                  <?php foreach ($peminjaman->getPetugas() as $petugas): ?>
                    <option value="<?= $petugas['id_petugas'] ?>">
                      <?= $petugas['nama_petugas'] ?>
                    </option>
                  <?php endforeach; ?>

                </select>
              </div>

              <button type="submit" name="save" class="btn btn-primary">Simpan</button>
              <button type="reset" class="btn btn-warning">RESET</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
<?php

if (empty($_GET['id_buku'])) {
  header("location: index.php?page=buku");
  exit(); // kode selanjut nya tidak akan di eksekusi
}

$id_buku = $_GET['id_buku'];
$pdo     = dataBase::connect();
$buku    = Buku::getInstance($pdo);

// Jika tombol 'save' ditekan
if (isset($_POST['save'])) {
  $judul          = htmlspecialchars($_POST['judul']);
  $id_kategori    = htmlspecialchars($_POST['nama_kategori']);
  $id_penulis     = htmlspecialchars($_POST['nama_penulis']);
  $penerbit       = htmlspecialchars($_POST['penerbit']);
  $tahun_terbit   = htmlspecialchars($_POST['tahun_terbit']);

  // Coba edit data buku dan cek hasilnya
  if ($buku->edit($id_buku, $judul, $id_kategori, $id_penulis, $penerbit, $tahun_terbit)) {
    header("location: index.php?page=buku&cek=updt");
    // exit();
  } else {
    echo "maaf data gagal di simpan";
  }

  // Jika tombol 'save' tidak ditekan, blok ini akan dieksekusi
} else {
  $data = $buku->getID($id_buku);
  if (!$data) {
    header("location: index.php?page=buku");
    exit();
  }

  //// Ambil data buku untuk ditampilkan di form
  $judul          = htmlspecialchars($data['judul']);
  $id_kategori    = htmlspecialchars($data['id_kategori']);
  $id_penulis     = htmlspecialchars($data['id_penulis']);
  $penerbit       = htmlspecialchars($data['penerbit']);
  $tahun_terbit   = htmlspecialchars($data['tahun_terbit']);
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit Petugas</title>
</head>

<body>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            Edit Buku
          </div>
          <div class="card-body">
            <form action="" method="POST">

              <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" value="<?php echo $judul; ?>" placeholder="Masukkan nama buku"
                  class="form-control">

              </div>

              <div class="form-group ">
                <label class="form-label">Kategori</label>
                <select class="form-control" name="nama_kategori">
                  <option value="">--pilih kategori--</option>
                  <?php
                  $pdo = dataBase::connect();
                  $buku = Buku::getInstance($pdo);
                  ?>
                  <?php foreach ($buku->getKategori() as $kategori): ?>
                    <option value="<?= $kategori['id_kategori'] ?>">
                      <?= $kategori['nama_kategori'] ?>
                    </option>
                  <?php endforeach; ?>

                </select>
              </div>


              <div class="form-group ">
                <label class="form-label">Penulis</label>
                <select class="form-control" name="nama_penulis">
                  <option value="">--penulis--</option>
                  <?php
                  $pdo = dataBase::connect();
                  $buku = Buku::getInstance($pdo);
                  ?>
                  <?php foreach ($buku->getPenulis() as $penulis): ?>
                    <option value="<?= $penulis['id_penulis'] ?>">
                      <?= $penulis['nama_penulis'] ?>
                    </option>
                  <?php endforeach; ?>

                </select>
              </div>

              <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" value="<?php echo $penerbit; ?>" placeholder="Masukkan penerbit buku"
                  class="form-control">
              </div>

              <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="<?php echo $tahun_terbit; ?>"
                  placeholder="Masukkan tahun terbit" class="form-control">
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
<?php

$pdo = dataBase::connect(); //menyimpan objek pdo ke dalam variable $pdo
$buku = Buku::getInstance($pdo);

if (isset($_POST['save'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $id_kategori = htmlspecialchars($_POST['nama_kategori']);
    $id_penulis = htmlspecialchars($_POST['nama_penulis']);
    $penerbit = htmlspecialchars($_POST['penerbit']);
    $tahun_terbit = htmlspecialchars($_POST['tahun_terbit']);

    $id_buku_baru = $buku->generateIdBuku();
    $result = $buku->tambah($id_buku_baru, $judul, $id_kategori, $id_penulis, $penerbit, $tahun_terbit);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=buku&cek=add';</script>";
    } else {
        echo "peringatan! data gagal di tambahkan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="text-center">Tambah Buku</h4>

                    </div>
                    <div class="card-body p-2">
                        <form action="" method="POST" class="border p-3">


                            <div class="form-group mb-2">
                                <label>Judul</label>
                                <input type="text" name="judul" placeholder="Masukkan Nama buku " class="form-control">
                            </div>

                            <div class="form-group mb-2">
                                <label class="form-label">Kategori</label>
                                <select class="form-control" name="nama_kategori">
                                    <option value="">--pilih kategori--</option>
                                    <?php
                                    $pdo = dataBase::connect();
                                    $buku = Buku::getInstance($pdo);
                                    ?>
                                    <?php foreach ($buku->getkategori() as $kategori): ?>
                                        <option value="<?= $kategori['id_kategori'] ?>">
                                            <?= $kategori['nama_kategori'] ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group mb-2">
                                <label class="form-label">penulis</label>
                                <select class="form-control" name="nama_penulis">
                                    <option value="">--pilih penulis--</option>
                                    <?php
                                    $pdo = dataBase::connect();
                                    $buku = Buku::getInstance($pdo);
                                    ?>
                                    <?php foreach ($buku->getpenulis() as $penulis): ?>
                                        <option value="<?= $penulis['id_penulis'] ?>">
                                            <?= $penulis['nama_penulis'] ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>


                            <div class="form-group mb-2">
                                <label>Penerbit</label>
                                <input type="text" name="penerbit" placeholder="Masukkan nama penerbit"
                                    class="form-control">
                            </div>

                            <div class="form-group mb-2">
                                <label>Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" placeholder="Masukkan tahun terbit"
                                    class="form-control">
                            </div>

                            <button type="submit" name="save" class="btn btn-success">Simpan</button>
                            <button type="reset" class="btn btn-danger">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
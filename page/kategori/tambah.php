<?php

$pdo = dataBase::connect(); //menyimpan objek pdo ke dalam variable $pdo

$kategori = Kategori::getInstance($pdo);

if (isset($_POST['save'])) {
    $nama_kategori = htmlspecialchars($_POST['nama_kategori']);

    $result = $kategori->tambah($nama_kategori);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=kategori&cek=add';</script>";
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
    <title>Tambah kategori</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Tambah kategori</h4>
                    </div>

                    <div class="card-body p-3 border ">
                        <form action="" method="POST" class="p-3 border  rounded shadow-sm bg-light">

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Kategori</label>
                                <input type="text" name="nama_kategori" placeholder="Masukkan Nama Lengkap"
                                    class="form-control border">
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" name="save" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
<?php

$pdo = dataBase::connect();
$peminjaman = Peminjaman::getInstance($pdo);
$id_peminjaman = $_GET['id_peminjaman'];

$durasi = $peminjaman->hitungDurasiPeminjaman($id_peminjaman);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>konfirmasi denda</title>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="card mt-5">
                    <form method="POST">
                        <!-- bagian id buku -->
                        <div class="row">
                            <div class=" shadow col-sm-8 offset-2">
                                <div class="card-header row justify-content-center">
                                    <div class="form-group col-5 mb-4">
                                        <label class="col-form-label text-md-right">ID Pinjam</label>
                                        <input type="text" class="form-control bg-info text-light" name="id_peminjaman"
                                            value="<?= htmlspecialchars($id_peminjaman) ?>" readonly>
                                    </div>

                                    <!-- Durasi Peminjaman -->
                                    <div class="form-group col-5 mb-4">
                                        <label class="col-form-label text-md-right">Durasi Peminjaman</label>
                                        <input type="text" class="form-control bg-info text-light"
                                            value="<?= htmlspecialchars($durasi) ?> hari" readonly>
                                    </div>

                                </div>
                                <p class="text-primary font-weight-bold text-center">
                                        <i class="fas fa-exclamation-triangle h3"></i>
                                        Jika buku terlambat dikembalikan, maka dikenakan denda.
                                    </p>
                                    <div class="text-center my-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/Open_book_nae_02.svg/800px-Open_book_nae_02.svg.png" class="" alt="" width="200px" height="auto">
                                </div>
                                </div>


                    </form>

                    <?php
                    // Tangkap data dari URL
                    $id_peminjaman = isset($_GET['id_peminjaman']) ? $_GET['id_peminjaman'] : '';
                    $denda = isset($_GET['denda']) ? $_GET['denda'] : '';
                    ?>
                    <form action="index.php?page=peminjaman&act=proses" method="post">
                        <div class="card-body">
                            <div class="form-group p-0">
                                <label for="jumlah_denda" class="text-dark">Jumlah Denda (Rp)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" name="denda" value="<?php echo $denda; ?>"
                                        placeholder="Masukkan jumlah denda">
                                </div>

                                <!-- Menyertakan id_peminjaman dan denda sebagai hidden fields -->
                                <input type="hidden" name="id_peminjaman" value="<?php echo $id_peminjaman; ?>">
                                <button type="submit" class="btn btn-primary mt-3" name="konfirmasi_denda">Konfirmasi
                                    Denda
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
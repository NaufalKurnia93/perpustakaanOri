<?php
// Menghubungkan ke database
$pdo = dataBase::connect();
$peminjaman = Peminjaman::getInstance($pdo);

if (isset($_POST['save'])) {
    // Mengambil dan membersihkan input
    $id_anggota = htmlspecialchars($_POST['nama_anggota']);
    $tanggal_pinjam = htmlspecialchars($_POST['tanggal_pinjam']);
    $tanggal_kembali = htmlspecialchars($_POST['tanggal_kembali']);
    $id_petugas = htmlspecialchars($_POST['nama_petugas']);

    // Menghasilkan ID peminjaman baru
    $id_peminjaman_baru = $peminjaman->generateIdPeminjaman();
    // var_dump($id_peminjaman_baru); // Debugging output

    // Menambahkan data peminjaman
    $result = $peminjaman->tambah($id_peminjaman_baru, $id_anggota, $tanggal_pinjam, $tanggal_kembali, $id_petugas);

    // Mengecek hasil operasi
    if ($result) {
        echo "<script>window.location.href = 'index.php?page=peminjaman&cek=add';</script>";
    } else {
        echo "<div class='alert alert-danger'>Peringatan! Data gagal ditambahkan.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah peminjaman</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Tambah peminjaman</h4>
                   
                </div>
                <div class="card-body p-4">
                    <form action="" method="POST" class="border p-3">

                        <div class="form-group mb-2">
                           <label class="form-label">Anggota</label>
                                <select class="form-control" name="nama_anggota">
                                <option value="">--pilih anggota--</option>
                                <?php
                            $pdo = dataBase::connect();
                            $peminjaman = Peminjaman::getInstance($pdo);
                            ?>
                                <?php foreach ($peminjaman->getAnggota() as $anggota) : ?>
                            <option value="<?= $anggota['id_anggota'] ?>"><?= $anggota['nama_anggota'] ?></option>
                                <?php 
                                 endforeach;
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" placeholder="Masukkan  tanggal pinjam" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>tanggal kembali</label>
                            <input type="date" name="tanggal_kembali" placeholder="Masukkan tanggal kembali" class="form-control">
                        </div>

                        <div class="form-group mb-2">
                           <label class="form-label">Petugas</label>
                                <select class="form-control" name="nama_petugas">
                                <option value="">--pilih petugas--</option>
                                <?php
                            $pdo = dataBase::connect();
                            $peminjaman = Peminjaman::getInstance($pdo);
                            ?>
                                <?php foreach ($peminjaman->getPetugas() as $petugas) : ?>
                            <option value="<?= $petugas['id_petugas'] ?>"><?= $petugas['nama_petugas'] ?></option>
                                <?php 
                                 endforeach;
                                ?>
                            </select>
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
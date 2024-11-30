<?php

$pdo = dataBase::connect(); //menyimpan objek pdo ke dalam variable $pdo

$petugas = Petugas::getInstance($pdo);

if (isset($_POST['save'])) {
    $nama_petugas = htmlspecialchars($_POST['nama_petugas']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $shift = htmlspecialchars($_POST['shift']);


    $result = $petugas->tambah($nama_petugas, $jenis_kelamin, $alamat, $jabatan, $shift);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=petugas&cek=add';</script>";
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
    <title>Tambah Petugas</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Tambah Petugas</h4>
                    </div>

                    <div class="card-body p-4 border ">
                        <form action="" method="POST" class="p-3 border">

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama_petugas" placeholder="Masukkan Nama Lengkap"
                                    class="form-control border">
                            </div>


                            <div class=" mb-2">
                                <label for="gender">Jenis Kelamin:</label>
                                <select class="form-control" name="jenis_kelamin">
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" placeholder="Masukkan Alamat Anda"
                                    class="form-control border">
                            </div>

                            <div class="mb-2">
                                <label>Jabatan</label>
                                <select class="form-control" name="jabatan">
                                    <option>Kepala Perpustakaan</option>
                                    <option>Teknisi Perpustakaan</option>
                                    <option>Pelayanan Pengguna</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label for="gender">Shift</label>
                                <select class="form-control" name="shift" required>
                                    <option>pagi</option>
                                    <option>siang</option>
                                    <option>sore</option>
                                </select>
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
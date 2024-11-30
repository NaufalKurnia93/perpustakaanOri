<?php

if (empty($_GET['id_petugas'])) {
    header("location: index.php?page=petugas");
    exit(); // kode selanjut nya tidak akan di eksekusi
}

$id_petugas = $_GET['id_petugas'];
$pdo = dataBase::connect();
$petugas = Petugas::getInstance($pdo);

// Jika tombol 'save' ditekan
if (isset($_POST['save'])) {
    $nama_petugas = htmlspecialchars($_POST['nama_petugas']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $shift = htmlspecialchars($_POST['shift']);

    // Coba edit data petugas dan cek hasilnya
    if ($petugas->edit($id_petugas, $nama_petugas, $jenis_kelamin, $alamat, $jabatan, $shift)) {
        header("location: index.php?page=petugas&cek=updt");
        exit();
    } else {
        echo "maaf data gagal di simpan";
    }

    // Jika tombol 'save' tidak ditekan, blok ini akan dieksekusi
} else {
    $data = $petugas->getID($id_petugas);
    if (!$data) {
        header("location: index.php?page=petugas");
        exit();
    }

    //// Ambil data petugas untuk ditampilkan di form
    $nama_petugas = htmlspecialchars($data['nama_petugas']);
    $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
    $alamat = htmlspecialchars($data['alamat']);
    $jabatan = htmlspecialchars($data['jabatan']);
    $shift = htmlspecialchars($data['shift']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Petugas</title>
</head>

<body>
    <div class="container" style="margin-top: 80px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>EDIT PETUGAS</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama_petugas" id="nama_petugas"
                                    value="<?php echo htmlspecialchars($nama_petugas); ?>"
                                    placeholder="Masukkan nama anda" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin"
                                    value="<?php echo htmlspecialchars($jenis_kelamin); ?>">
                                    <option>Laki-laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" value="<?php echo htmlspecialchars($alamat); ?>"
                                    placeholder="Masukkan alamat" class="form-control">
                            </div>

                            <div class=" mb-2">
                                <label>Jabatan</label>
                                <select class="form-control" name="jabatan"
                                    value="<?php echo htmlspecialchars($jabatan); ?>">
                                    <option>Kepala Perpustakaan</option>
                                    <option>Teknisi Perpustakaan</option>
                                    <option>Pelayanan Pengguna</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <label>Shift</label>
                                <select class="form-control" name="shift"
                                    value="<?php echo htmlspecialchars($shift); ?>">
                                    <option>pagi</option>
                                    <option>siang</option>
                                    <option>sore</option>
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-warning">RESET</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
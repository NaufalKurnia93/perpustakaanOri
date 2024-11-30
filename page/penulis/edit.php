<?php 
             
    if (empty($_GET['id_penulis'])) {
        header("location: index.php?page=penulis");
        exit(); // kode selanjut nya tidak akan di eksekusi
    }

    $id_penulis = $_GET['id_penulis'];
    $pdo = dataBase::connect();
    $penulis = Penulis::getInstance($pdo);

    // Jika tombol 'save' ditekan
        if (isset($_POST['save'])) {
            $nama_penulis = htmlspecialchars($_POST['nama_penulis']);
            $asal_negara = htmlspecialchars($_POST['asal_negara']);
            $jumlah_karya = htmlspecialchars($_POST['jumlah_karya']);

            // Coba edit data penulis dan cek hasilnya
        if ($penulis->edit($id_penulis, $nama_penulis, $asal_negara, $jumlah_karya)) {
            header("location: index.php?page=penulis&cek=updt");
            exit();
        } else {
            echo "maaf data gagal di simpan";
        }

                // Jika tombol 'save' tidak ditekan, blok ini akan dieksekusi
    } else {
        $data = $penulis->getID($id_penulis);
            if(!$data) {
                header("location: index.php?page=penulis");
                exit();
            }

//// Ambil data penulis untuk ditampilkan di form
            $nama_penulis = htmlspecialchars($data['nama_penulis']);
            $asal_negara = htmlspecialchars($data['asal_negara']);
            $jumlah_karya = htmlspecialchars($data['jumlah_karya']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit penulis</title>
</head>
<body>
    <div class="container" style="margin-top: 80px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>EDIT penulis</h4>
                    </div>
                        <div class="card-body">
                            <form action="" method="POST">
                            
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama_penulis" id="nama_penulis" value="<?php echo htmlspecialchars($nama_penulis); ?>" placeholder="Masukkan nama anda" class="form-control">
                            </div>


                            <div class="form-group">
                                <label>Negara kebangsaan</label>
                                <input type="text" name="asal_negara" value="<?php echo htmlspecialchars($asal_negara); ?>"placeholder="Masukkan asal_negara" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Jumlah Karya</label>
                                <input type="text" name="jumlah_karya"value="<?php echo htmlspecialchars($jumlah_karya); ?>"placeholder="Masukkan nomor handphone" class="form-control">
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
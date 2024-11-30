<?php
class Peminjaman
{
    private $db;
    private static $instance = null;

    // Konstruktor untuk menginisialisasi 
    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    // Mengambil instance dari kelas peminjaman(Singleton)
    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new Peminjaman($pdo);
            // echo "Koneksi klas berhasil!";
        }
        return self::$instance;
    }



    //menambah kan data play

    public function tambah($id_peminjaman, $id_anggota, $tanggal_pinjam, $tanggal_kembali, $id_petugas)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO peminjaman (id_peminjaman, id_anggota, tanggal_pinjam, tanggal_kembali, id_petugas, status) 
                                        VALUES (:id_peminjaman, :id_anggota, :tanggal_pinjam, :tanggal_kembali, :id_petugas, 'berlangsung')");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->bindParam(":tanggal_pinjam", $tanggal_pinjam);
            $stmt->bindParam(":tanggal_kembali", $tanggal_kembali);
            $stmt->bindParam(":id_petugas", $id_petugas);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }




    public function tambahDetail($id_peminjaman, $id_buku, $denda = null)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO peminjaman_detail (id_peminjaman, id_buku, denda) VALUES (:id_peminjaman, :id_buku, :denda)");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->bindParam(":id_buku", $id_buku);

            // Menghindari masalah jika denda tidak diberikan
            if ($denda === null) {
                $stmt->bindValue(":denda", null, PDO::PARAM_NULL);
            } else {
                $stmt->bindParam(":denda", $denda, PDO::PARAM_INT);
            }

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM peminjaman WHERE id_peminjaman= :id_peminjaman");
            $stmt->execute(array(":id_peminjaman" => $id_peminjaman));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }


    public function getBook($id_peminjaman)
    {
        try {
            $query = "SELECT * FROM buku WHERE id_buku NOT IN (SELECT id_buku FROM peminjaman_detail WHERE id_peminjaman = :id_peminjaman)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_peminjaman', $id_peminjaman);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function getDetail($id_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM peminjaman_detail
            JOIN buku ON peminjaman_detail.id_buku = buku.id_buku
            WHERE peminjaman_detail.id_peminjaman = :id_peminjaman
            ");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function generateIdPeminjaman()
    {
        $stmt = $this->db->prepare("SELECT MAX(id_peminjaman) as kodeTerbesar FROM peminjaman");
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_peminjaman_besar = $data['kodeTerbesar'];
        //mengkonfersi ke integer dan memulai dari posisi ke 3 dan length 3
        $urutan = (int) substr($id_peminjaman_besar, 3, 3);
        $urutan++;
        $huruf = "PJM";
        return $huruf . sprintf("%03s", $urutan); //
    }

    // memperbarui data play
    public function edit($id_peminjaman, $id_anggota, $tanggal_pinjam, $tanggal_kembali, $id_petugas)
    {
        try {
            $stmt = $this->db->prepare("UPDATE peminjaman SET id_anggota=:id_anggota,
            tanggal_pinjam=:tanggal_pinjam,
            tanggal_kembali=:tanggal_kembali,
            id_petugas=:id_petugas WHERE
            id_peminjaman=:id_peminjaman");

            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->bindParam(":tanggal_pinjam", $tanggal_pinjam);
            $stmt->bindParam(":tanggal_kembali", $tanggal_kembali);
            $stmt->bindParam(":id_petugas", $id_petugas);
            $stmt->execute();
            return true;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

    //operasi hapus data peminjamanplay
    public function hapus($id_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM peminjaman WHERE id_peminjaman= :id_peminjaman");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            // Debugging: Tampilkan parameter

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function hapusDetail($id_peminjaman, $id_buku)
    {
        try {
            $sql = "DELETE FROM peminjaman_detail WHERE id_peminjaman = :id_peminjaman AND id_buku = :id_buku";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_peminjaman', $id_peminjaman, PDO::PARAM_STR);
            $stmt->bindParam(':id_buku', $id_buku, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "Data berhasil dihapus.";
            } else {
                return "Data gagal dihapus.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }



    // operasi get all peminjaman play
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT peminjaman.*, anggota.nama_anggota, petugas.nama_petugas
            FROM peminjaman
                JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota 
                JOIN petugas ON peminjaman.id_petugas = petugas.id_petugas");

            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // mengambil semua baris hasil dari query
            return $data;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

    // operasi get anggota
    public function getAnggota()
    {
        try {
            $stmt = $this->db->prepare("SELECT id_anggota, nama_anggota FROM anggota");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    // operasi get petugas
    public function getPetugas()
    {
        try {
            $stmt = $this->db->prepare("SELECT id_petugas, nama_petugas FROM petugas");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function hitungDurasiPeminjaman($id_peminjaman)
{
    try {
        $stmt = $this->db->prepare("SELECT tanggal_pinjam, tanggal_kembali FROM peminjaman WHERE id_peminjaman = :id_peminjaman");
        $stmt->bindParam(":id_peminjaman", $id_peminjaman);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $tglPinjam = new DateTime($data['tanggal_pinjam']);
            $tglKembali = new DateTime($data['tanggal_kembali']);

            // Jika tanggal kembali lebih awal dari tanggal pinjam
            if ($tglKembali < $tglPinjam) {
                return -1; // Mengembalikan nilai negatif jika terlambat
            }

            $selisih = $tglKembali->diff($tglPinjam);
            return $selisih->days;
        } else {
            throw new Exception("Data peminjaman tidak ditemukan.");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}


    // Menghitung denda
    public function hitungDenda($id_peminjaman, $tarif_denda_per_hari)
    {
        try {
            $durasi = $this->hitungDurasiPeminjaman($id_peminjaman);
            $tanggal_kembali = new DateTime($this->getID($id_peminjaman)['tanggal_kembali']);
            $tanggal_sekarang = new DateTime();
            $keterlambatan = $tanggal_sekarang->diff($tanggal_kembali)->days;

            if ($keterlambatan > 0) {
                return $keterlambatan * $tarif_denda_per_hari;
            }
            return 0;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    // Mengambil denda untuk peminjaman tertentu
    public function getDenda($id_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("SELECT SUM(denda) as total_denda FROM peminjaman_detail WHERE id_peminjaman = :id_peminjaman");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data['total_denda'];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


public function konfirmasiDenda($id_peminjaman, $denda)
{
    try {
        $stmt = $this->db->prepare("UPDATE peminjaman_detail SET denda = :denda, status = 'Dikonfirmasi' WHERE id_peminjaman = :id_peminjaman");
        $stmt->bindParam(':denda', $denda, PDO::PARAM_INT);
        $stmt->bindParam(':id_peminjaman', $id_peminjaman);
        $stmt->execute();

        // Debugging
        error_log("Denda dikonfirmasi: id_peminjaman=$id_peminjaman, denda=$denda");

        return true;
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());
        return false;
    }
}



    public function prosesSelesaikanPeminjaman($id_peminjaman)
    {
        try {
            // Ambil data peminjaman
            $peminjaman = $this->getID($id_peminjaman);

            if (!$peminjaman) {
                throw new Exception("Peminjaman tidak ditemukan.");
            }

            // Menghitung batas waktu peminjaman
            $tanggal_kembali = new DateTime($peminjaman['tanggal_kembali']);
            $tanggal_sekarang = new DateTime();
            $selisih = $tanggal_sekarang->diff($tanggal_kembali)->days;

            // Jika peminjaman terlambat
            if ($selisih > 0) {
                // Hitung total denda
                $total_denda = $selisih; // Denda dihitung berdasarkan hari keterlambatan

                // Konfirmasi denda
                return [
                    'status' => 'konfirmasi_denda',
                    'total_denda' => $total_denda
                ];
            }

            // Jika tidak terlambat atau tidak ada denda, proses penyelesaian
            $this->selesaikanPeminjaman($id_peminjaman);

            return ['status' => 'selesai'];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function selesaikanPeminjaman($id_peminjaman)
    {
        try {
            // Hitung durasi peminjaman
            $durasi = $this->hitungDurasiPeminjaman($id_peminjaman);
    
            // Jika durasi kurang dari 0 (terlambat), hitung denda
            if ($durasi < 0) {
                $denda = abs($durasi) * 1000; // Menghitung denda
                
                // Cek apakah denda sudah dikonfirmasi
                $stmt = $this->db->prepare("SELECT status FROM peminjaman_detail WHERE id_peminjaman = :id_peminjaman");
                $stmt->bindParam(':id_peminjaman', $id_peminjaman);
                $stmt->execute();
                $status = $stmt->fetchColumn();
    
                if ($status !== 'Dikonfirmasi') {
                    // Redirect ke halaman konfirmasi denda jika belum dikonfirmasi
                    header("Location: index.php?page=peminjaman&act=denda&cek=konfir&id_peminjaman=" . urlencode($id_peminjaman) . "&denda=" . urlencode($denda));
                    exit; // Keluar dari eksekusi selanjutnya
                }
            }
    
            // Jika tidak ada denda atau denda sudah dikonfirmasi, selesaikan peminjaman
            $stmt = $this->db->prepare("UPDATE peminjaman SET status = 'selesai' WHERE id_peminjaman = :id_peminjaman");
            $stmt->bindParam(':id_peminjaman', $id_peminjaman);
            $stmt->execute();
    
            // Hapus detail peminjaman
            $stmt = $this->db->prepare("DELETE FROM peminjaman_detail WHERE id_peminjaman = :id_peminjaman");
            $stmt->bindParam(':id_peminjaman', $id_peminjaman);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    

}
?>
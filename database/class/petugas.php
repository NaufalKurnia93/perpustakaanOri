<?php
    class Petugas {
        private $db;
        private static $instance = null;
    
        // Konstruktor untuk menginisialisasi koneksi database
    public function __construct($db_conn) {   
        $this->db = $db_conn;
    }

     // Mengambil instance dari kelas Petugas(Singleton)
    public static function getInstance($pdo) { 
        if (self::$instance == null) {
            self::$instance = new Petugas($pdo);
            // echo "Koneksi klas berhasil!";
        }
        return self::$instance;
    }

    

    //menambah kan data play

public function tambah($nama_petugas, $jenis_kelamin, $alamat, $jabatan, $shift) {
    try {
        $stmt = $this->db->prepare("INSERT INTO petugas (nama_petugas, jenis_kelamin, alamat, jabatan, shift) VALUES (:nama_petugas, :jenis_kelamin, :alamat, :jabatan, :shift)");

    $stmt->bindParam(":nama_petugas", $nama_petugas);
    $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
    $stmt->bindParam(":alamat", $alamat);
    $stmt->bindParam(":jabatan", $jabatan);
    $stmt->bindParam(":shift", $shift);
     $stmt->execute();
    return true;
} catch (PDOException $e) {
    echo $e->getMessage();
    return false;
    }
} 
    public function getID($id_petugas) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM petugas WHERE id_petugas = :id_petugas");
            $stmt->execute(array(":id_petugas" => $id_petugas));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $error) {
            echo $error-> getMessage();
            return false;
        }
    }

    // memperbarui data play
    public function edit($id_petugas, $nama_petugas, $jenis_kelamin, $alamat, $jabatan, $shift) {
        try {
            $stmt = $this->db->prepare("UPDATE petugas SET nama_petugas=:nama_petugas, jenis_kelamin=:jenis_kelamin,
            alamat=:alamat,
            jabatan=:jabatan,
            shift=:shift WHERE
            id_petugas=:id_petugas");

            $stmt->bindParam(":id_petugas", $id_petugas);
            $stmt->bindParam(":nama_petugas", $nama_petugas);
            $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":jabatan", $jabatan);
            $stmt->bindParam(":shift", $shift);
            $stmt->execute();
            return true;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

    //operasi hapus data anggota play
    public function hapus($id_petugas) {
        try {
            $stmt = $this->db->prepare("DELETE FROM petugas WHERE id_petugas = :id_petugas");
            $stmt->bindParam(":id_petugas", $id_petugas);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    } 

    // operasi get all petugas play
    public function getAll() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM petugas");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

}

?>
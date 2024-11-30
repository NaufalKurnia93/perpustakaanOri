<?php
    class Anggota {
        private $db;
        private static $instance = null;
    
        // Konstruktor untuk menginisialisasi 
    public function __construct($db_conn) {   
        $this->db = $db_conn;
    }

     // Mengambil instance dari kelas Anggota(Singleton)
    public static function getInstance($pdo) { 
        if (self::$instance == null) {
            self::$instance = new Anggota($pdo);
            // echo "Koneksi klas berhasil!";
        }
        return self::$instance;
    }

    

    //menambah kan data play

public function tambah($nama_anggota, $alamat, $no_telpon) {
    try {
        $stmt = $this->db->prepare("INSERT INTO anggota (nama_anggota, alamat, no_telpon) VALUES (:nama_anggota, :alamat, :no_telpon)");

    $stmt->bindParam(":nama_anggota", $nama_anggota);
    $stmt->bindParam(":alamat", $alamat);
    $stmt->bindParam(":no_telpon", $no_telpon);
     $stmt->execute();
    return true;
} catch (PDOException $e) {
    echo $e->getMessage();
    return false;
    }
} 
    public function getID($id_anggota) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->execute(array(":id_anggota" => $id_anggota));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $error) {
            echo $error-> getMessage();
            return false;
        }
    }

    // memperbarui data play
    public function edit($id_anggota, $nama_anggota, $alamat, $no_telpon) {
        try {
            $stmt = $this->db->prepare("UPDATE anggota SET nama_anggota=:nama_anggota, alamat=:alamat,
            no_telpon=:no_telpon WHERE
            id_anggota=:id_anggota");

            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->bindParam(":nama_anggota", $nama_anggota);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":no_telpon", $no_telpon);
            $stmt->execute();
            return true;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

    //operasi hapus data anggota play
    public function hapus($id_anggota) {
        try {
            $stmt = $this->db->prepare("DELETE FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    } 

    // operasi get all anggota play
    public function getAll() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);  // mengambil semua baris hasil dari query
            return $data;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

}

?>
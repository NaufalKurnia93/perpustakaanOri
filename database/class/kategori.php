<?php
    class Kategori {
        private $db;
        private static $instance = null;
    
        // Konstruktor untuk menginisialisasi kon
    public function __construct($db_conn) {   
        $this->db = $db_conn;
    }

     // Mengambil instance dari kelas Kategori(Singleton)
    public static function getInstance($pdo) { 
        if (self::$instance == null) {
            self::$instance = new Kategori($pdo);
            // echo "Koneksi klas berhasil!";
        }
        return self::$instance;
    }

    

    //menambah kan data play

public function tambah($nama_kategori) {
    try {
        $stmt = $this->db->prepare("INSERT INTO kategori (nama_kategori) VALUES (:nama_kategori)");

    $stmt->bindParam(":nama_kategori", $nama_kategori);
     $stmt->execute();
    return true;
} catch (PDOException $e) {
    echo $e->getMessage();
    return false;
    }
} 
    public function getID($id_kategori) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM kategori WHERE id_kategori = :id_kategori");
            $stmt->execute(array(":id_kategori" => $id_kategori));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $error) {
            echo $error-> getMessage();
            return false;
        }
    }

    // memperbarui data play
    public function edit($id_kategori, $nama_kategori) {
        try {
            $stmt = $this->db->prepare("UPDATE kategori SET nama_kategori=:nama_kategori WHERE
            id_kategori=:id_kategori");

            $stmt->bindParam(":id_kategori", $id_kategori);
            $stmt->bindParam(":nama_kategori", $nama_kategori);
            $stmt->execute();
            return true;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

    //operasi hapus data anggota play
    public function hapus($id_kategori) {
        try {
            $stmt = $this->db->prepare("DELETE FROM kategori WHERE id_kategori = :id_kategori");
            $stmt->bindParam(":id_kategori", $id_kategori);
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
            $stmt = $this->db->prepare("SELECT * FROM kategori");
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
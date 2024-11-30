<?php
    class Penulis {
        private $db;
        private static $instance = null;
    
        // Konstruktor untuk menginisialisasi kon
    public function __construct($db_conn) {   
        $this->db = $db_conn;
    }

     // Mengambil instance dari kelas Penulis(Singleton)
    public static function getInstance($pdo) { 
        if (self::$instance == null) {
            self::$instance = new Penulis($pdo);
            // echo "Koneksi klas berhasil!";
        }
        return self::$instance;
    }

    

    //menambah kan data play

public function tambah($nama_penulis, $asal_negara, $jumlah_karya) {
    try {
        $stmt = $this->db->prepare("INSERT INTO penulis (nama_penulis, asal_negara, jumlah_karya) VALUES (:nama_penulis, :asal_negara, :jumlah_karya)");

    $stmt->bindParam(":nama_penulis", $nama_penulis);
    $stmt->bindParam(":asal_negara", $asal_negara);
    $stmt->bindParam(":jumlah_karya", $jumlah_karya);
     $stmt->execute();
    return true;
} catch (PDOException $e) {
    echo $e->getMessage();
    return false;
    }
} 
    public function getID($id_penulis) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM penulis WHERE id_penulis = :id_penulis");
            $stmt->execute(array(":id_penulis" => $id_penulis));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $error) {
            echo $error-> getMessage();
            return false;
        }
    }

    // memperbarui data play
    public function edit($id_penulis, $nama_penulis, $asal_negara, $jumlah_karya) {
        try {
            $stmt = $this->db->prepare("UPDATE penulis SET nama_penulis=:nama_penulis, asal_negara=:asal_negara,
            jumlah_karya=:jumlah_karya WHERE
            id_penulis=:id_penulis");

            $stmt->bindParam(":id_penulis", $id_penulis);
            $stmt->bindParam(":nama_penulis", $nama_penulis);
            $stmt->bindParam(":asal_negara", $asal_negara);
            $stmt->bindParam(":jumlah_karya", $jumlah_karya);
            $stmt->execute();
            return true;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

    //operasi hapus data penulis play
    public function hapus($id_penulis) {
        try {
            $stmt = $this->db->prepare("DELETE FROM penulis WHERE id_penulis = :id_penulis");
            $stmt->bindParam(":id_penulis", $id_penulis);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    } 

    // operasi get all penulis play
    public function getAll() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM penulis");
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
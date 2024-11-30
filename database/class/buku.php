<?php
    class Buku {
        private $db;
        private static $instance = null;
    
        // Konstruktor untuk menginisialisasi kon
    public function __construct($db_conn) {   
        $this->db = $db_conn;
    }

     // Mengambil instance dari kelas buku(Singleton)
    public static function getInstance($pdo) { 
        if (self::$instance == null) {
            self::$instance = new Buku($pdo);
            // echo "Koneksi klas berhasil!";
        }
        return self::$instance;
    }

    

    //menambah kan data play

public function tambah($id_buku,$judul, $id_kategori, $id_penulis, $penerbit, $tahun_terbit) {
    try {
        $stmt = $this->db->prepare("INSERT INTO buku (id_buku, judul, id_kategori, id_penulis, penerbit, tahun_terbit) VALUES (:id_buku, :judul, :id_kategori, :id_penulis, :penerbit, :tahun_terbit)");

    $stmt->bindParam(":id_buku", $id_buku);
    $stmt->bindParam(":judul", $judul);
    $stmt->bindParam(":id_kategori", $id_kategori);
    $stmt->bindParam(":id_penulis", $id_penulis);
    $stmt->bindParam(":penerbit", $penerbit);
    $stmt->bindParam(":tahun_terbit", $tahun_terbit);
     $stmt->execute();
    return true;
} catch (PDOException $e) {
    echo $e->getMessage();
    return false;
    }
} 
    public function getID($id_buku) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM buku WHERE id_buku = :id_buku");
            $stmt->execute(array(":id_buku" => $id_buku));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $error) {
            echo $error-> getMessage();
            return false;
        }
    }

    public function generateIdBuku()
{
    $stmt = $this->db->prepare("SELECT MAX(id_buku) as kodeTerbesar FROM buku");
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_buku_besar = $data['kodeTerbesar'];

    // Mengambil bagian numerik dari ID buku dan mengkonversinya menjadi integer
    $urutan = (int) substr($id_buku_besar, 4, 4); //posisi 4 dan panjang 4
    $urutan++;
    $huruf = "BOk_";
     // Format urutan dengan 3 digit, tambahkan 0 jika perlu, 
    return $huruf . sprintf("%03s", $urutan);
}
    

    // memperbarui data play
    public function edit($id_buku, $judul, $id_kategori, $id_penulis, $penerbit, $tahun_terbit) {
        try {
            $stmt = $this->db->prepare("UPDATE buku SET judul=:judul,
            id_kategori=:id_kategori,
            id_penulis=:id_penulis,
            penerbit=:penerbit,
            tahun_terbit=:tahun_terbit WHERE
            id_buku=:id_buku");

            $stmt->bindParam(":id_buku", $id_buku);
            $stmt->bindParam(":judul", $judul);
            $stmt->bindParam(":id_kategori", $id_kategori);
            $stmt->bindParam(":id_penulis", $id_penulis);
            $stmt->bindParam(":penerbit", $penerbit);
            $stmt->bindParam(":tahun_terbit", $tahun_terbit);
            $stmt->execute();
            return true;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

    //operasi hapus data buku play
    public function hapus($id_buku) {
        try {
            $stmt = $this->db->prepare("DELETE FROM buku WHERE id_buku = :id_buku");
            $stmt->bindParam(":id_buku", $id_buku);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    } 

    // operasi get all buku play
    public function getAll() {
        try {
            $stmt = $this->db->prepare("SELECT buku.*, kategori.nama_kategori, penulis.nama_penulis 
            FROM buku
            JOIN kategori ON kategori.id_kategori = buku.id_kategori
            JOIN penulis ON penulis.id_penulis = buku.id_penulis");

            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);  // mengambil semua baris hasil dari query
            return $data;
        } catch (PDOException $error) {
            echo $error->getMessage();
            return false;
        }
    }

    
    // operasi get kategori
    public function getKategori()
    {
        try {
            $stmt = $this->db->prepare("SELECT id_kategori, nama_kategori FROM kategori");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // operasi get penulis
    public function getPenulis()
    {
        try {
            $stmt = $this->db->prepare("SELECT id_penulis, nama_penulis FROM penulis");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}

?>
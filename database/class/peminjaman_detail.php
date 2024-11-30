<?php

    class Peminjaman_detail {
        private $db;
        private static $instance = null;
    
        // Konstruktor untuk menginisialisasi 
    public function __construct($db_conn) {   
        $this->db = $db_conn;
    }

     // Mengambil instance dari kelas peminjaman(Singleton)
    public static function getInstance($pdo) { 
        if (self::$instance == null) {
            self::$instance = new Peminjaman_detail($pdo);
            // echo "Koneksi klas berhasil!";
        }
        return self::$instance;
    }

    

public function hapusDetail($id_peminjaman, $id_buku)
{
    try {

        // Siapkan query SQL untuk menghapus data
        $stmt = $this->db->prepare("DELETE FROM peminjaman_detail WHERE id_peminjaman = :id_peminjaman AND id_buku = :id_buku");

        
        // Ikat parameter dengan tipe data yang benar
        $stmt->bindParam(":id_buku", $id_buku); // Periksa jika id_buku adalah string
        $stmt->bindParam(":id_peminjaman", $id_peminjaman); // Periksa jika id_peminjaman adalah string

        // Debugging: Tampilkan parameter
        $stmt->debugDumpParams();
        
        // Eksekusi statement
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        // Tangani exception dan tampilkan pesan error
        echo $e->getMessage();
        return false;
    }
}

    }
//     public function getID($id_peminjaman_detail) {
//         try {
//             $stmt = $this->db->prepare("SELECT * FROM peminjaman_detail WHERE id_peminjaman_detail= :id_peminjaman_detail");
//             $stmt->execute(array(":id_peminjaman_detail" => $id_peminjaman_detail));
//             $data = $stmt->fetch(PDO::FETCH_ASSOC);
//             return $data;
//         } catch (PDOException $error) {
//             echo $error-> getMessage();
//             return false;
//         }
//     }

//     // memperbarui data play
//     public function edit($id_peminjaman_detail, $id_peminjaman, $id_buku, $denda) {
//         try {
//             $stmt = $this->db->prepare("UPDATE peminjaman_detail SET id_peminjaman=:id_peminjaman,
//             id_buku=:id_buku,
//             denda=:denda WHERE
//             id_peminjaman_detail=:id_peminjaman_detail");

//             $stmt->bindParam(":id_peminjaman_detail", $id_peminjaman_detail);
//             $stmt->bindParam(":id_peminjaman", $id_peminjaman);
//             $stmt->bindParam(":id_buku", $id_buku);
//             $stmt->bindParam(":denda", $denda);
//             $stmt->execute();
//             return true;
//         } catch (PDOException $error) {
//             echo $error->getMessage();
//             return false;
//         }
//     }

//     //operasi hapus data peminjamanplay
//     public function hapus($id_peminjaman_detail) {
//         try {
//             $stmt = $this->db->prepare("DELETE FROM peminjaman_detail WHERE id_peminjaman_detail= :id_peminjaman_detail");
//             $stmt->bindParam(":id_peminjaman_detail", $id_peminjaman_detail);
//             $stmt->execute();
//             return true;
//         } catch (PDOException $e) {
//             echo $e->getMessage();
//             return false;
//         }
//     } 

//     // operasi get all peminjaman play
//     public function getAll() {
//         try {
//             $stmt = $this->db->prepare("SELECT peminjaman_detail.*, peminjaman.id_peminjaman, buku.judul
//             FROM peminjaman_detail
//                 JOIN peminjaman ON peminjaman_detail.id_peminjaman = peminjaman.id_peminjaman 
//                 JOIN buku ON peminjaman_detail.id_buku = buku.id_buku");

//             $stmt->execute();
//             $data = $stmt->fetchAll(PDO::FETCH_ASSOC);  // mengambil semua baris hasil dari query
//             return $data;
//         } catch (PDOException $error) {
//             echo $error->getMessage();
//             return false;
//         }
//     }

//         // operasi get peminjaman
//     //     public function getPeminjaman($id_peminjaman_detail)
//     // {
//     //     try {
//     //         $stmt = $this->db->prepare("SELECT * FROM peminjaman, buku WHERE peminjaman.id_buku = buku.id_buku AND id_peminjaman_detail = :id_peminjaman_detail");
//     //         $stmt->bindParam(":id_peminjaman_detail", $id_peminjaman_detail);
//     //         $stmt->execute();
//     //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     //     } catch (PDOException $e) {
//     //         echo $e->getMessage();
//     //     }
//     // }

// //     public function getPeminjaman()
// // {
// //     try {
// //         $stmt = $this->db->prepare("SELECT id_peminjaman FROM peminjaman");
// //         $stmt->execute();
// //         return $stmt->fetchAll(PDO::FETCH_ASSOC);
// //     } catch (PDOException $e) {
// //         echo $e->getMessage();
// //         return [];
// //     }
// // }

// public function getPeminjaman($id_peminjaman)
// {
//     try {
//         $stmt = $this->db->prepare("SELECT * FROM peminjaman_detail, buku WHERE peminjaman_detail.id_id_buku = buku.id_buku AND id_peminjaman = :id_peminjaman");
//         $stmt->bindParam(":id_peminjaman", $id_peminjaman);
//         $stmt->execute();
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }
// }

 

    
//     // operasi get buku
//     public function getBuku($id_peminjaman)
// {
//     try {
//         $query = "SELECT * FROM buku WHERE id_buku NOT IN (SELECT id_buku FROM peminjaman_detail WHERE id_peminjaman = :id_peminjaman)";
//         $stmt = $this->db->prepare($query);
//         $stmt->bindParam(':id_peminjaman', $id_peminjaman);
//         $stmt->execute();

//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }
// }


// }

?>
<?php

class Access
{
    private $db; // Koneksi ke database
    private $error; // Tempat menyimpan pesan error
    private static $instance = null; // Menyimpan satu instance dari kelas ini

    // Konstruktor untuk inisialisasi koneksi database dan memulai sesi
    public function __construct($db_conn)
    {
        $this->db = $db_conn;
        @session_start(); // Memulai sesi
    }

    // Mendapatkan instance dari kelas ini
    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new Access($pdo); // Membuat instance baru jika belum ada
        }
        return self::$instance;
    }

    // Menambahkan data pengguna baru
    public function new_user($nama, $username, $email, $no_telp, $password, $role)
    {
        try {
            $this->cekUsernameDanEmail($username, $email); // Mengecek apakah username dan email sudah ada
            $hashPassword = password_hash($password, PASSWORD_DEFAULT); // Mengamankan password
            // Menyimpan data pengguna baru ke database
            $stmt = $this->db->prepare("INSERT INTO users (nama, username, email, no_telp, password, role) 
                                        VALUES(:nama, :username ,:email,  :no_telp, :password, :role)");

            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":no_telp", $no_telp);
            $stmt->bindParam(":password", $hashPassword);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
            return true; // Berhasil
        } catch (PDOException $e) {
            if ($e->errorInfo[0] === '23000') { // Jika email sudah terdaftar
                $this->error = "Email ini sudah terdaftar. Gunakan email lain.";
                return false; // Gagal
            } else {
                echo $e->getMessage(); // Menampilkan pesan error
                return false; // Gagal
            }
        }
    }

    // Fungsi untuk login pengguna
    public function login($username, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $data = $stmt->fetch();

            if ($stmt->rowCount() > 0) {
                if (password_verify($password, $data["password"])) {
                    $_SESSION['user_id'] = $data['id'];
                    $_SESSION['role'] = $data['role']; // Menyimpan role pengguna
                    return true;
                } else {
                    $this->error = 'Username atau Password Salah';
                    return false;
                }

        
            } else {
                $this->error = 'Username Atau Password Salah';
                return false; // Gagal
            }
        } catch (PDOException $e) {
            echo $e->getMessage(); // Menampilkan pesan error
            return false; // Gagal
        }
    }

    // Mengecek apakah pengguna sudah login
    public function cekLogin()
    {
        // Periksa apakah variabel sesi 'user_id' ada
        return isset($_SESSION["user_id"]);
    }
    

    // Mendapatkan data pengguna yang sedang login
    public function cari_pengguna()
    {
        if (!$this->cekLogin()) {
            return false; // Jika belum login
        }
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(":id", $_SESSION['user_id']);
            $stmt->execute();
            return $stmt->fetch(); // Mengembalikan data pengguna
        } catch (PDOException $e) {
            echo $e->getMessage(); // Menampilkan pesan error
            return false; // Gagal
        }
    }

    // Menghapus sesi pengguna untuk logout
    public function loGout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['role']);
        session_destroy(); // Menghentikan  dan menghapus sesi
        return true; // Berhasil
    }

    // Mengecek apakah username dan email sudah ada
    public function cekUsernameDanEmail($username, $email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $this->error = " Username dan email sudah ada";
                 return true;
            } else {
                // echo "Username dan email tidak ditemukan."; // Username dan email belum ada
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage(); // Menampilkan pesan error
        }
    }

    // Mengubah password jika lupa
    public function lupaPaswd($email, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $this->NewPassword($email, $password); // Mengubah password
                echo "Username Dan Email sesuai password diganti";
                return true; // Berhasil
            } else {
                echo "Username Dan Email yang dimasukkan tidak sesuai";
                return false; // Gagal
            }
        } catch (PDOException $e) {
            echo $e->getMessage(); // Menampilkan pesan error
        }
    }

    // Mengubah password pengguna
    public function NewPassword( $email, $password)
    {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT); // Mengamankan password
            $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE email = :email");
            $stmt->bindParam(":password", $hash);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return true; // Berhasil
        } catch (PDOException $e) {
            echo $e->getMessage(); // Menampilkan pesan error
        }
    }

    // Mengambil pesan error terakhir
    public function getError()
    {
        return $this->error; // Mengembalikan pesan error
    }
}

<?php

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function validateLogin($username, $password)
    {
        // Cek login mahasiswa
        $queryMahasiswa = "SELECT id_mahasiswa, NIM, nama_mahasiswa FROM mahasiswa WHERE NIM = ? AND password_mahasiswa = ?";
        $stmtMahasiswa = sqlsrv_query($this->conn, $queryMahasiswa, [$username, $password]);

        if ($stmtMahasiswa && $resultMahasiswa = sqlsrv_fetch_array($stmtMahasiswa, SQLSRV_FETCH_ASSOC)) {
            return $resultMahasiswa; // Mengembalikan data mahasiswa
        }

        // Cek login dosen
        $queryDosen = "SELECT id_dosen, NIDN, role_dosen, nama_dosen FROM dosen WHERE NIDN = ? AND password_dosen = ?";
        $stmtDosen = sqlsrv_query($this->conn, $queryDosen, [$username, $password]);

        if ($stmtDosen && $resultDosen = sqlsrv_fetch_array($stmtDosen, SQLSRV_FETCH_ASSOC)) {
            return $resultDosen; // Mengembalikan data dosen
        }

        return null; // Tidak ditemukan data login
    }
}
?>

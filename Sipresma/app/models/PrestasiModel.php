<?php
class PrestasiModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getPrestasiByMahasiswa($id_mahasiswa)
    {
        $query = "SELECT * FROM data_prestasi WHERE id_mahasiswa = ?";
        $params = [$id_mahasiswa];

        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $prestasiList = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $prestasiList[] = $row;
        }

        return $prestasiList;
    }

    public function getAllPrestasi()
    {
        $query = "SELECT * FROM data_prestasi";
        $stmt = sqlsrv_query($this->conn, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $prestasiList = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $prestasiList[] = $row;
        }

        return $prestasiList;
    }

    public function getPrestasiById($id_prestasi)
    {
        $query = "
            SELECT p.*, 
                   STUFF((SELECT ', ' + m.nama_mahasiswa
                          FROM mahasiswa m
                          JOIN mahasiswa_prestasi mp ON m.id_mahasiswa = mp.id_mahasiswa
                          WHERE mp.id_prestasi = p.id_prestasi
                          FOR XML PATH('')), 1, 2, '') AS nama_mahasiswa, 
                   STUFF((SELECT ', ' + d.nama_dosen
                          FROM dosen d
                          JOIN dosen_prestasi dp ON d.id_dosen = dp.id_dosen
                          WHERE dp.id_prestasi = p.id_prestasi
                          FOR XML PATH('')), 1, 2, '') AS nama_dosen
            FROM data_prestasi p
            WHERE p.id_prestasi = ?";
        $params = [$id_prestasi];

        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }

    public function updateStatusPrestasi($id_prestasi, $status)
    {
        $query = "UPDATE data_prestasi SET status_pengajuan = ? WHERE id_prestasi = ?";
        $params = [$status, $id_prestasi];

        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        return true;
    }

    public function tolakPrestasi($id_prestasi, $alasan)
    {
        $query1 = "INSERT INTO alasan_penolakan (id_prestasi, alasan) VALUES (?, ?)";
        $params1 = [$id_prestasi, $alasan];

        $stmt1 = sqlsrv_query($this->conn, $query1, $params1);

        if ($stmt1 === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $query2 = "UPDATE data_prestasi SET status_pengajuan = 'ditolak' WHERE id_prestasi = ?";
        $params2 = [$id_prestasi];

        $stmt2 = sqlsrv_query($this->conn, $query2, $params2);

        if ($stmt2 === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        return true;
    }

    public function getAlasanPenolakan($id_prestasi)
    {
        $query = "SELECT alasan, tgl_penolakan FROM alasan_penolakan WHERE id_prestasi = ? ORDER BY tgl_penolakan DESC";
        $params = [$id_prestasi];

        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $alasanList = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $alasanList[] = $row;
        }

        return $alasanList;
    }
}

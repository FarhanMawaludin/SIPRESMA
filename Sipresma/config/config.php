<?php
$host = "LAPTOP-CACRPO0M\SQLEXPRESS";
$connInfo = array("Database" => "sipresma", "UID" => "", "PWD" => ""); 
$conn = sqlsrv_connect($host, $connInfo); 

if ($conn) { 
    // echo "Koneksi Berhasil. <br>";
}else{
    echo "Koneksi Gagal. <br>";
    die( print_r( sqlsrv_errors(), true));
}

?>
<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "inventaris1";
$koneksi = new mysqli($host, $username, '', $db_name);
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}
?>
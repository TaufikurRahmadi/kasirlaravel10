<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "tambe_ruet";
//melakukan koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);
//cek kondisi dari koneksi
if (!$conn) {
echo "Database gagal tersambung, cek koneksi database Anda";
}
?>
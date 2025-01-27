<?php

include 'koneksi.php';

$id = $_GET['id'];

$cek = mysqli_query($conn, "SELECT id_jurusan from data_mahasiswa where id_jurusan = '$id'");

if (mysqli_num_rows($cek) > 0) {
    echo '<script>
    alert("Jurusan Tidak Bisa Dihapus, Data jurusan masih terisi");
    window.location.href="data_jurusan.php";
    </script>';
} else {
    $hapus = mysqli_query($conn, "DELETE FROM data_jurusan where id_jurusan = '$id'");
    if ($hapus) {
        echo '<script>
        alert("data berhasil di hapus");
        window.location.href="data_jurusan.php";
        </script>';
    }
}

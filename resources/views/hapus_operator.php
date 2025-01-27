<?php
include 'koneksi.php';
$id = $_GET['id'];
$hapus = mysqli_query($conn, "DELETE FROM operator_sistem where id_operator = '$id'");
if ($hapus) {
echo '<script>
alert("data berhasil di hapus");
window.location.href="data_operator.php";
</script>';
}
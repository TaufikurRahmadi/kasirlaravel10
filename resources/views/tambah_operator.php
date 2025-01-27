<?php include 'layout/header.php'; ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="data_operator.php">Data operator</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah operator</li>
    </ol>
</nav>
<form method="POST" action="" class="card">
    <div class="card-header">
        Form Mahasiswa
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <label for="">Nama Operator</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="nama_operator" placeholder="Masukkan nama operator...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Email</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="email_operator" placeholder="Masukkan email operator...">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3">
                <label for="">Password</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="password_operator" placeholder="masukkan password....">
            </div>
       
    </div>
    <div class="card-footer">
        <button name="simpan" class="btn btn-success">Simpan Data</button>
        <a href="data_operator.php" class="btn btn-danger">Kembali</a>
    </div>
</form>
<?php
include 'layout/footer.php';
include 'koneksi.php';

function Nim($conn, $id_operator)
{
    $query = "SELECT COUNT(*) as count FROM operator_sistem WHERE id_operator = '$id_operator'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}

if (isset($_POST['simpan'])) {
    $nama_operator = $_POST['nama_operator'];
    $email = $_POST['email_operator'];
    $password = $_POST['password_operator'];
  
    if (Nim($conn, $email)) {
        echo '<div class="container mt-3"><div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><b>Data Gagal Disimpan! </b>NIM <b>'. $email.'</b> Sudah ada
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div></div>';
    } else {

        $simpan = mysqli_query($conn, "INSERT INTO operator_sistem (
                                                nama_operator, 
                                                email_operator, 
                                                password_operator) 
                                                VALUES('$nama_operator', 
                                                '$email', 
                                                '$password')");
        if ($simpan) {
            echo '<script>
        alert("data berhasil disimpan");
        window.location.href="data_operator.php";
        </script>';
        }
    }
}
?>
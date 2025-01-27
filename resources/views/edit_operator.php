<?php
include 'layout/header.php';

include 'koneksi.php';
if (isset($_POST['edit'])) {
    $id = $_GET['id_operator'];
    $nama_operator = $_POST['nama_operator'];
    $email = $_POST['email_operator'];
    $password = $_POST['password_operator'];
    $simpan = mysqli_query($conn, "UPDATE operator_sistem
SET  nama_operator = '$nama_operator', email_operator = '$email', password_operator = '$password'
where id_operator = '$id'");
    if ($simpan) {
        echo '<script>
alert("data berhasil di edit");
window.location.href="data_operator.php";
</script>';
    }
}

include 'koneksi.php';
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM operator_sistem where id_operator = '$id'");
$get = mysqli_fetch_array($query);
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="data_operator.php">Data operator</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit data operator</li>
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
            <d class="col-lg-9">
                <input type="text" class="form-control" value="<?= $get['nama_operator'] ?>" name="nama_operator" placeholder="Masukkan nama operator...">
            </div>
        </div>
        <div class="row st-3">
            <div class="col-lg-3">
                <label for="">Email Operator</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="<?= $get['email_operator'] ?>" name="email_operator" placeholder="Masukkan email baru...">
            </div>
        </div>
        <div class="row st-3">
            <div class="col-lg-3">
                <label for="">Password Operator</label>
            </div>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="<?= $get['password_operator'] ?>" name="password_operator" placeholder="masukkan password baru">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button name="edit" class="btn btn-success">Edit Data</button>
        <a href="data_operator.php" class="btn btn-danger">Kembalt</a>
    </div>
</form>
<?php
include 'layout/footer.php';
?>